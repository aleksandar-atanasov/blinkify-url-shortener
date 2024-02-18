<?php

namespace Modules\ShortLink\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\JsonResponse;
use Modules\ShortLink\Http\Requests\CreateShortLinkRequest;
use Modules\ShortLink\Services\LinkService;

class CreateShortLinkController extends Controller
{

    public function __construct(
        private readonly LinkService $linkService,
    )
    {
    }

    public function __invoke(CreateShortLinkRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $shortLinkData = $this->linkService->createShortLink($request);
            DB::commit();
        }catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'data' => [
                'short_link' => $shortLinkData->shortUrl,
                'original_url' => $shortLinkData->originalUrl,
                'domain' => $shortLinkData->domain,
            ]
        ]);
    }
}
