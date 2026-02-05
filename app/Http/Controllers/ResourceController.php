<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class ResourceController extends Controller
{
    abstract protected function modelClass(): string;

    abstract protected function translationModelClass(): string;

    abstract protected function validatedData(Request $request, ?int $id = null): array;

    abstract protected function validatedTranslationData(Request $request, ?int $id = null): array;

    public function create()
    {
        return view($this->viewPath('create'));
    }

    public function store(Request $request): RedirectResponse
    {
        $class = $this->modelClass();

        $mainData = $this->validatedData($request);
        $translationData = $this->validatedTranslationData($request);
        $item = $class::create($mainData);

        $item->translations()->create($translationData);

        return redirect()->route('page.show', ['slug' => '']);
    }

    public function show($id)
    {
        $class = $this->modelClass();
        $variable = strtolower(class_basename($class));
        $$variable = $class::with('translations')->findOrFail($id);

        return view($this->viewPath('view'), compact($variable));
    }

    public function edit($id, Request $request)
    {
        $class = $this->modelClass();
        $variable = strtolower(class_basename($class));
        $$variable = $class::with('translations')->findOrFail($id);

        $locales = Locale::query()->get();
        $selectedLocale = $request->query('locale', 1);

        return view($this->viewPath('edit'), compact($variable, 'locales', 'selectedLocale'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $class = $this->modelClass();
        $item = $class::findOrFail($id);

        $mainData = $this->validatedData($request, $id);
        $translationData = $this->validatedTranslationData($request, $id);
        $localeId = $request->input('locale_id');

        $item->update($mainData);

        $translation = $item->translations()->where('locale_id', $localeId)->first();

        if ($translation) {
            $translation->update($translationData);
        } else {
            $translationData['locale_id'] = $localeId;
            $item->translations()->create($translationData);
        }

        return redirect()->route($this->routeName('show'), $id);
    }

    public function destroy($id): RedirectResponse
    {
        $class = $this->modelClass();
        $item = $class::findOrFail($id);
        $item->delete();

        return redirect()->route('page.show', ['slug' => '']);
    }

    protected function viewPath(string $view): string
    {
        return $this->viewPrefix().'.'.$view;
    }

    protected function routeName(string $name): string
    {
        return $this->routePrefix().'.'.$name;
    }

    abstract protected function viewPrefix(): string;

    abstract protected function routePrefix(): string;
}
