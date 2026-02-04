<x-layout title="Create Subject">
    <div class="flex justify-center mx-auto border border-zinc-400 w-135 rounded-xl bg-white p-8 shadow-xl">
        <form action="{{ route('subjects.store') }}" method="POST" class="flex flex-col gap-2" x-data="{
            open: false,
            selectedLocaleId: @js($locales[0]->id),
            titles: {},
            touched: {}
        }">
            @csrf

            <div class="flex flex-col justify-center items-center gap-4 mb-4">
                <div class="flex gap-4 justify-center items-center  gap-4">
                    <div class="relative">
                        <button type="button" @click="open = !open"
                                class="flex items-center gap-2 border border-zinc-300 rounded-xl p-2 w-full justify-between">
                            <img :src="selectedLocale.image" alt="selectedLocale.name" class="h-5 w-5" src="">
                            @svg('heroicon-o-chevron-down', 'h-4 w-4')
                        </button>

                        <ul x-show="open" @click.away="open = false" x-cloak
                            class="absolute mt-1 w-full border border-zinc-200 bg-white z-10">
                            @foreach ($locales as $locale)
                                <li @click="selectedLocaleId = {{ $locale->id }}; open = false"
                                    class="flex items-center justify-center p-2 hover:bg-gray-100 cursor-pointer">
                                    <img src="{{ asset($locale->image) }}" class="h-5 w-5" alt="{{ $locale->name }}">
                                    <span class="ml-2">{{ $locale->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach ($locales as $locale)
                        <div x-show="selectedLocaleId === {{ $locale->id }}" x-cloak>
                            <input type="text" name="titles[{{ $locale->id }}]"
                                   placeholder="Title for {{ $locale->name }}" class="rounded-xl border w-full"
                                   x-model="titles[{{ $locale->id }}]" @blur="touched[{{ $locale->id }}] = true">
                        </div>

                <p x-show="touched[{{ $locale->id }}] && (!titles[{{ $locale->id }}] || !titles[{{ $locale->id }}].trim())"
                   class="text-red-500 text-xs mt-1">
                    Title is required.
                </p>
                @endforeach
            </div>


            <input type="submit" value="Add Subject" class="btn mt-4">
        </form>
    </div>
</x-layout>
