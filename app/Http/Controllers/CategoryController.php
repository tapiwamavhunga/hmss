<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Medicine;
use App\Repositories\CategoryRepository;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request): View
    {
        $data['statusArr'] = Category::STATUS_ARR;

        return view('categories.index', $data);
    }

    /**
     * Store a newly created Category in storage.
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->create($input);

        return $this->sendSuccess(__('messages.flash.medicine_category_saved'));
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function show(Category $category)
    {
        if (! canAccessRecord(Category::class, $category->id)) {
            Flash::error(__('messages.flash.not_allow_access_record'));

            return Redirect::back();
        }

        $medicines = $category->medicines;

        return view('categories.show', compact('medicines', 'category'));
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(Category $category): JsonResponse
    {
        if (! canAccessRecord(Category::class, $category->id)) {
            Flash::error(__('messages.flash.not_allow_access_record'));

            return Redirect::back();
        }

        return $this->sendResponse($category, __('messages.flash.medicine_category_retrieved'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Category $category, UpdateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.flash.medicine_category_updated'));
    }

    /**
     * Remove the specified Category from storage.
     *
     *
     * @throws Exception
     */
    public function destroy(Category $category): JsonResponse
    {
        if (! canAccessRecord(Category::class, $category->id)) {
            return $this->sendError(__('messages.flash.medicine_category_not_found'));
        }

        $medicineCategoryModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineCategoryModel, 'category_id', $category->id);
        if ($result) {
            return $this->sendError(__('messages.flash.medicine_category_cant_deleted'));
        }
        $this->categoryRepository->delete($category->id);

        return $this->sendSuccess(__('messages.flash.medicine_category_deleted'));
    }

    public function activeDeActiveCategory(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return $this->sendSuccess(__('messages.flash.medicine_category_updated'));
    }
}
