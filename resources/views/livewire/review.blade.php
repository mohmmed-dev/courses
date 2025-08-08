<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <!-- You can open the modal using ID.showModal() method -->
    <button class="btn" onclick="my_modal_3.showModal()">open modal</button>
    <dialog id="my_modal_3" class="modal">
    <div class="modal-box">
        <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <form wire:submit="save" class="form-control flex-col">
            <label class="label">
                <span class="label-text">{{__("Review")}}</span>
            </label>
            <div>
            <textarea  wire:model="review" class="textarea resize-none w-full" placeholder="{{__("Review")}}"></textarea>
                <div class="w-full max-w-xs mt-3">
                <input type="range" min="1" wire:model="rating" max="5" value="1" class="range" step="1" />
                <div class="flex rating justify-between px-2.5 mt-2 text-xs w-full">
                    <div class="mask mask-star bg-yellow-500" aria-label="1 star" aria-current="true"></div>
                    <div class="mask mask-star  bg-yellow-500" aria-label="2 star" aria-current="true"></div>
                    <div class="mask mask-star  bg-yellow-500" aria-label="3 star" aria-current="true"></div>
                    <div class="mask mask-star  bg-yellow-500" aria-label="4 star" aria-current="true"></div>
                    <div class="mask mask-star  bg-yellow-500" aria-label="5 star" aria-current="true"></div>
                </div>
                </div>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">{{__("Submit")}}</button>
            </div>
        </form>
    </div>
    </dialog>
</div>
