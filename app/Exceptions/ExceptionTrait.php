<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ExceptionTrait
{
	public function apiException($request, $e)
	{
		if ($this->isModel($e))
        {
            return response()->json([
                "errors" => "Product Model Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        if ($this->isHttp($e))
        {
            return response()->json([
                "errors" => "Url Not Found"
            ], Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $exception);
	}

	protected function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}

	protected function isHttp($e)
	{
		return $e instanceof NotFoundHttpException;
	}
}
