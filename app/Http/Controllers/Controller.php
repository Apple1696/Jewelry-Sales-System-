<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.",
 *      title="Tài liệu API cho ứng dụng Mobifiber",
 *      @OA\License(
 *          name="Tedev",
 *      )
 * ),
 * @OA\Tag(
 *  name="1. Auth",
 *  description="API xác thực ời dùng kèm trả về thông tin người dùng hiện tại"
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
