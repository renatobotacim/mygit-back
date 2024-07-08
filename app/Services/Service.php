<?php

namespace App\Services;

use App\Helpers\Logs;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HTTP_RESPONSE;

class Service
{

    /**
     * @param array|object $data
     * @return void
     */
    function registerLog(array|object $data): void
    {
        try {
            $newData['url'] = request()->server()['HTTP_HOST'] . request()->server()['REQUEST_URI'];
            $newData['method'] = request()->server()['REQUEST_METHOD'];
            $newData['ip'] = request()->server()['REMOTE_ADDR'];
            $newData['input'] = json_encode(request());
            $newData['response'] = json_encode($data);
            DB::table('request_logs')->insertGetId($newData);
        } catch (\Exception $e) {
            //TODO implementar regra no caso do log não for registrado
        }
    }

    /**
     * @param object|array|null $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function returnRequestSucess(object|array|null $data, string $message = null): JsonResponse
    {
        return response()->json(
            [
                'message' => $message ?? 'Solicitação concluída com sucesso!',
                'data' => $data
            ], HTTP_RESPONSE::HTTP_OK
        );
    }

    /**
     * @param array|object|null $data
     * @param string|null $message
     * @param int|null $code
     * @return JsonResponse
     */
    public function returnRequestWarning(array|object|null $data, string $message = null, int $code = null): JsonResponse
    {
        return response()->json(
            [
                'message' => $message ?? 'Unable to update record. Try again!',
                'data' => $data
            ], $code ?? 422 //unprocessable content
        );
    }

    /**
     * @param array|object $erro
     * @param string|null $message
     * @return JsonResponse
     */
    public function returnRequestError(array|object $erro, string $message = null): JsonResponse
    {
        return response()->json(
            [
                'message' => $message ?? 'OPSS! An internal error has occurred. Try again later.',
                'error' => (array)$erro
            ], HTTP_RESPONSE::HTTP_INTERNAL_SERVER_ERROR
        );
    }

}
