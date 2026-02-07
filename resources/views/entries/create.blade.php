<x-layout :title="__('entry.create')">
    <h1 class="font-bold text-xl mb-4">@lang('entry.create')</h1>
    <form action="{{ route('entry.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        <div class="flex flex-col gap-4 mb-4">
            <div x-data="{
                subjects: @js($subjects),
                subject: @js($subjects->firstWhere('id', old('subject_id')))
            }" class="flex flex-col gap-4">
                @error('unique')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="flex flex-col gap-2">
                    <label for="subject_id">@lang('entry.label.subject')</label>
                    <select id="subject_id" name="subject_id" class="px-2 py-1 border" required
                        @change="subject = subjects.find(s => s.id == $event.target.value)">
                        <option value="">@lang('entry.placeholder.subject')</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2" x-show="subject?.units" x-cloak>
                    <label for="unit">@lang('entry.label.unit')</label>
                    <select id="unit" name="unit" class="px-2 py-1 border" required>
                        <template x-for="i in subject?.units">
                            <option :value="i" x-text="i" :selected="i == @js(old('unit', 1))">
                            </option>
                        </template>
                    </select>
                </div>

                <div class="flex flex-col gap-2" x-show="subject?.units" x-cloak>
                    <label for="number">@lang('entry.label.number')</label>
                    <input type="number" id="number" name="number" min="1" max="100"
                        value="{{ old('number', 1) }}" class="w-fit" required>
                    @error('number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div x-data="{ statementOption: {{ old('statement', 0) }} }" class="flex flex-col gap-4" x-show="subject?.units" x-cloak>
                    <div class="flex gap-4">
                        <label>@lang('entry.label.statement')</label>

                        <div class="flex gap-2 items-center">
                            <button type="button" @click="statementOption = 0"
                                :class="statementOption === 0 ?
                                    'bg-gray-100 h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center' :
                                    'bg-white h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center hover:bg-gray-100'">
                                @svg('heroicon-o-pencil-square', 'h-4 w-4')
                            </button>

                            <button type="button" @click="statementOption = 1"
                                :class="statementOption === 1 ?
                                    'bg-gray-100 h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center' :
                                    'bg-white h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center hover:bg-gray-100'">
                                @svg('heroicon-o-photo', 'h-4 w-4')
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="statement" :value="statementOption">

                    <template x-if="statementOption === 0">
                        <textarea name="statement_text" placeholder="@lang('entry.placeholder.statement')" class="w-full" cols="30" rows="3">{{ old('statement_text') }}</textarea>
                    </template>

                    <template x-if="statementOption === 1">
                        <x-dropzone-file field="statement_image[]" name="statement_image" />
                    </template>

                    @error('statement_text')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    @error('statement_image')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ solutionOption: {{ old('solution', 0) }} }" class="flex flex-col gap-4" x-show="subject?.units" x-cloak>
                    <div class="flex gap-4">
                        <label>@lang('entry.label.solution')</label>

                        <div class="flex gap-2 items-center">
                            <button type="button" @click="solutionOption = 0"
                                :class="solutionOption === 0 ?
                                    'bg-gray-100 h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center' :
                                    'bg-white h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center hover:bg-gray-100'">
                                @svg('heroicon-o-pencil-square', 'h-4 w-4')
                            </button>

                            <button type="button" @click="solutionOption = 1"
                                :class="solutionOption === 1 ?
                                    'bg-gray-100 h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center' :
                                    'bg-white h-6 w-6 border border-zinc-200 p-1 rounded flex justify-center items-center hover:bg-gray-100'">
                                @svg('heroicon-o-photo', 'h-4 w-4')
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="solution" :value="solutionOption">

                    <template x-if="solutionOption === 0">
                        <textarea name="solution_text" placeholder="@lang('entry.placeholder.solution')" class="w-full" cols="30" rows="3">{{ old('solution_text') }}</textarea>
                    </template>

                    <template x-if="solutionOption === 1">
                        <x-dropzone-file field="solution_image[]" name="solution_image" />
                    </template>

                    @error('solution_text')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    @error('solution_image')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="locale_id" value="1">
            </div>
            <input type="submit" value="@lang('entry.button.add')" class="btn mt-4">
        </div>
    </form>
</x-layout>
