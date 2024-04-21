<?php

namespace Modules\ShortLink\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Modules\ShortLink\Services\LinkService;

class RedirectToOriginalUrlController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService,
    )
    {
    }

    public function __invoke(string $shortUrl): RedirectResponse|JsonResponse
    {
        try {
            $shortLinkData = $this->linkService->getOriginalLink($shortUrl);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
        return redirect()->away($shortLinkData->originalUrl);
    }
}
