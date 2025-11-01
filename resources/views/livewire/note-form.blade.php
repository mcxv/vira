<div>
    <button
        wire:click="openModal"
        class="bg-black text-white px-4 py-2 rounded-md flex items-center mr-auto">
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        ایجاد نوشته جدید
    </button>

    @if($showModal)
    <div class="fixed inset-0 bg-black backdrop-blur-sm bg-opacity-50 flex items-center justify-center p-4 z-50" x-cloak>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        {{ $noteId ? 'ویرایش یادداشت' : 'ایجاد نوشته جدید' }}
                    </h2>
                    <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

                @if(session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">عنوان</label>
                                <input
                                    type="text"
                                    wire:model="title"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="عنوان یادداشت را وارد کنید">
                                @error('title')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">تاریخ (مثال 1404/10/20)</label>
                                <input
                                    type="text" style="direction:ltr"
                                    wire:model="persianDate"
                                    class="text-left w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="تاریخ یادداشت را وارد کنید">
                                @error('persianDate')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">کاربر</label>
                                <select
                                    wire:model="userId"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">انتخاب کاربر</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('userId')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">توضیحات *</label>
                            <textarea
                                wire:model="content"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="متن یادداشت را وارد کنید"></textarea>
                            @error('content')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="flex items-center">
                            <input
                                type="checkbox"
                                wire:model="status"
                                id="status"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 ml-2">
                            <label for="status" class="text-sm font-medium text-gray-700">
                                انجام شده
                            </label>
                        </div> -->

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">فایل پیوست</label>
                            <input
                                type="file"
                                wire:model="attachment"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('attachment')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror

                            @if($attachment)
                            <p class="text-sm text-green-600 mt-1">فایل انتخاب شده : {{ $attachment->getClientOriginalName() }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 space-x-reverse mt-6 pt-4 border-t border-gray-200">
                        <!-- <button 
                                type="button"
                                wire:click="closeModal"
                                class="px-4 py-2 cursor-pointer text-black bg-white border border-black rounded-md">
                                انصراف
                            </button> -->
                        <button
                            type="submit"
                            class="px-4 py-2 cursor-pointer bg-black text-white border border-black rounded-md">
                            {{ $noteId ? 'تایید و ویرایش' : 'تایید و ثبت' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>