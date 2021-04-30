<?php

namespace App\Http\Resources;

use Dogebank\Shared\Application\ResponseDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseDTOResource extends JsonResource
{
    /** @var ResponseDTO */
    public $resource;

    /**
     * @param ResponseDTO $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
