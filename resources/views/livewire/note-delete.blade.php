<div>
    @if($confirmingDeletion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">تأیید حذف</h3>
                    <p class="text-gray-600 text-center mb-6">
                        آیا از حذف این یادداشت اطمینان دارید؟ این عمل قابل بازگشت نیست.
                    </p>
                    
                    <div class="flex justify-center space-x-3 space-x-reverse">
                        <button 
                            wire:click="closeModal"
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                            انصراف
                        </button>
                        <button 
                            wire:click="delete"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>