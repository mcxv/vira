<div>
    @if($message)
    <div class="mb-6 transition-all duration-300" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex justify-between items-center">
            <span>{{ $message }}</span>
        </div>
    </div>
    @else
    <div class="mb-6">
        <div class="px-4 py-3 rounded flex justify-between items-center">
            <span>&nbsp;</span>
        </div>
    </div>
    @endif
    <div class="flex justify-between md:items-center md:flex-row flex-col mb-6 md:gap-0 gap-4">
        <h1 class="text-2xl font-bold">نوشته های من</h1>
        <div class="flex sm:flex-row flex-col-reverse gap-3 sm:mr-auto">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 absolute mt-1.5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>

            <input
                type="text"
                wire:model.live="search"
                class="w-120 pl-3 pr-10 py-2 rounded-md bg-gray-100 text-gray-950 !outline-none !ring-0"
                placeholder="جستجو...">

            @livewire('note-form')
        </div>
    </div>
    <div class="flex justify-between sm:items-center sm:flex-row flex-col mb-6 md:gap-0 gap-4">
        <select
            wire:model.live="userFilter" id="userFilter"
            class="w-full sm:w-[15rem] pr-3 pl-6 py-2 rounded-md bg-gray-100 text-gray-800 !outline-none !ring-0">

            @if($notes->count() > 0)
            <option value="">انتخاب کاربر</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->full_name }}
            </option>
            @endforeach
            @else
            <option selected>همه کاربران</option>
            <option disabled>
                کاربری یافت نشد.
            </option>
            @endif
        </select>
        <div class="flex mr-auto gap-4">
            <label class="block font-medium text-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>فیلتر بر اساس:</label>
            <span
                wire:click="setStatusFilter('')"
                class="cursor-pointer
                        {{ $statusFilter === '' ? 
                           'text-black font-medium' : 
                           'text-gray-700 font-normal' }}">
                همه
            </span>
            <span
                wire:click="setStatusFilter('1')"
                class="cursor-pointer
                        {{ $statusFilter === '1' ? 
                           'text-black font-medium' : 
                           'text-gray-700 font-normal' }}">
                انجام شده
            </span>
            <span
                wire:click="setStatusFilter('0')"
                class="cursor-pointer
                        {{ $statusFilter === '0' ? 
                           'text-black font-medium' : 
                           'text-gray-700 font-normal' }}">
                انجام نشده
            </span>
        </div>
    </div>

    @if($notes->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($notes as $note)
        <div wire:click="toggleNoteStatus({{ $note->id }})" title="" class="{{ $note->status ? 'from-[#7dbd46] to-[#539917]' : 'from-[#e17865] to-[#b4402b]' }} cursor-pointer bg-gradient-to-b text-white rounded-2xl p-4 md:p-5">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-bold">{{ $note->title }}</h3>
                    <p class="font-normal text-xs">{{ $note->user->full_name }}</p>
                </div>
                <div class="flex justify-end space-x-2 space-x-reverse">
                    <button title="ویرایش یادداشت"
                        wire:click="$dispatch('openEditModal', { noteId: {{ $note->id }} })"
                        onclick="event.stopPropagation()"
                        class="p-2 border-none rounded-full bg-white z-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                    <button
                        wire:click="$dispatch('openDeleteModal', { noteId: {{ $note->id }} })"
                        onclick="event.stopPropagation()"
                        class="p-2 border-none rounded-full bg-white z-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>

                    </button>
                </div>
            </div>

            <p class="text-sm mb-4 min-h-[4rem]">
                {{ $note->short_content }}
            </p>

            <div class="flex justify-between items-center text-sm pt-4 border-t">

                @if($note->attachment)
                <a href="{{ Storage::url(json_decode($note->attachment)->path) }}"
                    target="_blank"
                    onclick="event.stopPropagation()"
                    class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                    </svg> فایل پیوست <small>({{json_decode($note->attachment)->size}} مگابایت)</small>
                </a>

                @endif

                <span class="mr-auto" title="{{ $note->created_at->format('Y/m/d H:i') }}">
                    {{ $note->jalali_created_at }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </span>
            </div>

        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $notes->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <div class="text-gray-500 mb-4">
            <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">یادداشتی یافت نشد!</h3>
    </div>
    @endif
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('resetMessage', () => {
            setTimeout(() => {
                @this.set('message', '');
            }, 5000);
        });
    });
</script>