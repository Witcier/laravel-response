<?php

namespace Witcier\LaravelResponse\Support\Facades;

/*
 * This file is part of the Witcier/laravel-response.
 *
 * (c) Witcier <770201276@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Config;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\ArraySerializer as FractalArraySerializer;

class ArraySerializer extends FractalArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param  string  $resourceKey
     * @param  array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        $paginationDataField = Config::get('response.format.paginated_resource.data_field', 'data');

        return [$resourceKey ?: $paginationDataField => $data];
    }

    /**
     * Serialize the paginator.
     *
     * @param  PaginatorInterface  $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();
        $isSimplePaginator = property_exists($paginator->getPaginator(), 'hasMore');

        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'per_page' => (int) $paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
            'links' => [],
        ];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage || ($isSimplePaginator && $paginator->getPaginator()->hasMore)) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }

        if (empty($pagination['links'])) {
            $pagination['links'] = (object) [];
        }

        if ($isSimplePaginator) {
            unset($pagination['total'], $pagination['total_pages']);
        }

        return ['pagination' => $pagination];
    }
}
