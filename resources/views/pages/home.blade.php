<x-layout title="Welcome!">
    <div
        class="flex justify-center mx-auto border border-zinc-400 h-180 w-135 rounded-xl bg-white p-8 shadow-xl relative">
        <div class="flex flex-col flex-1">
            <p class="mb-4">
                <span class="text-xl mb-4">@lang('app.welcome')</span><br>
                <span class="text-lg">@lang('app.description')</span>
            </p>
            @if ($subjects->count() > 0)
                <p>@lang('app.subjects.found')</p>

                <ul class="list-inside list-disc mb-4">
                    @foreach ($subjects as $subject)
                        <li>
                            <a href="{{ url('subjects/' . $subject->id) }}" class="link">
                                {{ $subject->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>@lang('app.subjects.!found')</p>
            @endif

            <p>@lang('app.subjects.create')</p>
        </div>
    </div>
</x-layout>
