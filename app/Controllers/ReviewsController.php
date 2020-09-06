<?php

namespace App\Controllers;

use App\Validators\ReviewsValidator;
use CQ\Controllers\Controller;
use CQ\DB\DB;
use CQ\Helpers\UUID;
use Exception;

class ReviewsController extends Controller
{
    /**
     * List reviews.
     *
     * @return Json
     */
    public function index()
    {
        $reviews = DB::select('reviews', [
            'id',
            'score',
            'name',
            'description',
        ], []);

        return $this->respondJson(
            '',
            $reviews
        );
    }

    /**
     * Create reviews.
     *
     * @param object $request
     *
     * @return Html
     */
    public function create($request)
    {
        try {
            ReviewsValidator::create($request->data);
        } catch (Exception $e) {
            return $this->respondJson(
                'De data was incorrect',
                json_decode($e->getMessage()),
                422
            );
        }

        $data = [
            'id' => UUID::v6(),
            'name' => $request->data->name,
            'score' => $request->data->score,
            'description' => $request->data->description,
        ];

        DB::create('reviews', $data);

        return $this->respondJson('Review Aangemaakt', [
            'reload' => true,
        ]);
    }

    /**
     * Update reviews.
     *
     * @param object $request
     * @param string $id
     *
     * @return Html
     */
    public function update($request, $id)
    {
        try {
            ReviewsValidator::update($request->data);
        } catch (Exception $e) {
            return $this->respondJson(
                'De data was incorrect',
                json_decode($e->getMessage()),
                422
            );
        }

        $review = DB::get('reviews', [
            'score',
            'name',
            'description',
        ], ['id' => $id]);

        if (!$review) {
            return $this->respondJson(
                'Review niet gevonden',
                [],
                404
            );
        }

        $data = [
            'score' => $request->data->score ?: $review['score'],
            'name' => $request->data->name ?: $review['name'],
            'description' => $request->data->description ?: $review['description'],
        ];

        DB::update(
            'reviews',
            $data,
            [
                'id' => $id,
            ]
        );

        return $this->respondJson('Review Updated', [
            'reload' => true,
        ]);
    }

    /**
     * Delete reviews.
     *
     * @param string $id
     *
     * @return Html
     */
    public function delete($id)
    {
        DB::delete('reviews', ['id' => $id]);

        return $this->respondJson('Review Verwijderd', [
            'reload' => true,
        ]);
    }
}
