<?php

namespace App\Repositories;

use App\Models\TestimonialPost;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TestimonialPostRepository
{
    public function findOrFail(string|int $id): TestimonialPost
    {
        return TestimonialPost::query()->whereKey($id)->firstOrFail();
    }

    public function paginateForAdmin(?string $locale, int $perPage = 20): LengthAwarePaginator
    {
        $query = TestimonialPost::with('user')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($locale) {
            $query->where('locale', $locale);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function toggleVisibility(TestimonialPost $post): void
    {
        $post->update(['is_visible' => !$post->is_visible]);
    }

    public function delete(TestimonialPost $post): void
    {
        $post->delete();
    }

    public function moveUp(TestimonialPost $post): void
    {
        $swap = TestimonialPost::where('locale', $post->locale)
            ->where('display_order', '<', $post->display_order)
            ->orderBy('display_order', 'desc')
            ->first();

        if (!$swap) {
            return;
        }

        $currentOrder = $post->display_order;
        $post->update(['display_order' => $swap->display_order]);
        $swap->update(['display_order' => $currentOrder]);
    }

    public function moveDown(TestimonialPost $post): void
    {
        $swap = TestimonialPost::where('locale', $post->locale)
            ->where('display_order', '>', $post->display_order)
            ->orderBy('display_order', 'asc')
            ->first();

        if (!$swap) {
            return;
        }

        $currentOrder = $post->display_order;
        $post->update(['display_order' => $swap->display_order]);
        $swap->update(['display_order' => $currentOrder]);
    }
}
