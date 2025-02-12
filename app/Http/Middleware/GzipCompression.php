<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GzipCompression
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 🛑 Bypass compression for Livewire, Vite, and WebSocket requests
        if ($this->shouldBypassCompression($request)) {
            return $response;
        }

        // ✅ Ensure response is compressible and not already compressed
        if ($response instanceof Response && $this->shouldCompress($request, $response)) {
            $encoding = $this->getPreferredEncoding($request);

            if ($encoding === 'gzip') {
                $compressedContent = gzencode($response->getContent(), 6);
                $response->headers->set('Content-Encoding', 'gzip');
            } elseif ($encoding === 'br' && function_exists('brotli_compress')) {
                $compressedContent = brotli_compress($response->getContent(), 6);
                $response->headers->set('Content-Encoding', 'br');
            } else {
                return $response; // No valid encoding found
            }

            // ✅ Set headers for compressed response
            $response->setContent($compressedContent);
            $response->headers->set('Vary', 'Accept-Encoding');
            $response->headers->set('Content-Length', strlen($compressedContent));
        }

        return $response;
    }

    /**
     * 🛑 Bypass Compression for Livewire, Vite, and WebSocket Requests
     */
    private function shouldBypassCompression(Request $request): bool
    {
        return $request->header('X-Livewire') // Livewire AJAX requests
            || $request->is('livewire/*') // Livewire components
            || $request->is('vite/*') // Vite HMR requests
            || $request->is('ws/*') // WebSocket connections
            || $request->header('Accept', '') === 'text/event-stream'; // SSE streams
    }

    /**
     * ✅ Determine if the response should be compressed
     */
    private function shouldCompress(Request $request, Response $response): bool
    {
        return $this->isCompressibleType($response->headers->get('Content-Type'))
            && !$this->isAlreadyCompressed($response);
    }

    /**
     * ✅ Check if content type is compressible
     */
    private function isCompressibleType(?string $contentType): bool
    {
        return $contentType && preg_match('/(text|json|javascript|xml|css)/i', $contentType);
    }

    /**
     * ✅ Ensure response is not already compressed
     */
    private function isAlreadyCompressed(Response $response): bool
    {
        return $response->headers->has('Content-Encoding');
    }

    /**
     * ✅ Determine the best compression method (gzip or brotli)
     */
    private function getPreferredEncoding(Request $request): ?string
    {
        $acceptEncoding = $request->header('Accept-Encoding', '');

        if (strpos($acceptEncoding, 'br') !== false && function_exists('brotli_compress')) {
            return 'br'; // Use Brotli if supported
        } elseif (strpos($acceptEncoding, 'gzip') !== false) {
            return 'gzip'; // Otherwise, use Gzip
        }

        return null;
    }
}
