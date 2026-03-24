<?php

namespace App\Services;

use App\Models\TestimonialPost;
use App\Repositories\TestimonialPostRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TestimonialPostService
{
    public function __construct(
        private readonly TestimonialPostRepository $repository,
    ) {
    }

    public function paginateForAdmin(?string $locale): LengthAwarePaginator
    {
        return $this->repository->paginateForAdmin($locale);
    }

    public function findOrFail(string|int $id): TestimonialPost
    {
        return $this->repository->findOrFail($id);
    }

    public function toggleVisibility(TestimonialPost $post): void
    {
        $this->repository->toggleVisibility($post);
    }

    public function delete(TestimonialPost $post): void
    {
        $this->repository->delete($post);
    }

    public function moveUp(TestimonialPost $post): void
    {
        $this->repository->moveUp($post);
    }

    public function moveDown(TestimonialPost $post): void
    {
        $this->repository->moveDown($post);
    }
}
