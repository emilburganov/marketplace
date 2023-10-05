<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'category_name' => 'required|string|min:4',
            'category_icon' => 'required|image|mimes:svg|max:2048',
        ]);

        $icon = file_get_contents($request->file('category_icon'));

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        Category::query()->create([
            'name' => $request->input('category_name'),
            'icon' => $icon,
        ]);

        $request->session()->flash('category_message', 'Category successfully created!');

        return redirect()->back();
    }

    public function edit(Request $request, $category_id): RedirectResponse
    {
        $category = Category::query()->find($category_id);
        $request->session()->flash('category_flash', $category);

        return redirect()
            ->back()
            ->withInput();
    }

    public function update(Request $request, $category_id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'category_name' => 'required|string|min:4',
            'category_icon' => 'required|image|mimes:svg|max:2048',
        ]);

        $icon = file_get_contents($request->file('category_icon'));
        $category = Category::query()->find($category_id);

        if ($validation->fails()) {
            $request->session()->flash('category_flash', $category);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors());
        }

        $category->update([
            'name' => $request->input('category_name'),
            'icon' => $icon,
        ]);

        $request->session()->flash('category_message', 'Category successfully updated!');

        return redirect()->back();
    }

    public function delete($category_id): RedirectResponse
    {
        $category = Category::query()->find($category_id);
        $category->delete();

        session()->flash('category_message', 'Category successfully deleted!');

        return redirect()->back();
    }
}
