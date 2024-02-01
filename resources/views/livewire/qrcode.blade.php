<div class="p-4 md:p-5 border-b rounded-t">


    <h3 class="flex justify-center text-xl font-semibold text-gray-900 items-center">
        VEHICLE QR CODE
    </h3>

    <div class="flex justify-center p-4 md:p-5">
        {{-- {!! $qrcode->size(400) !!} --}}
        @foreach ($qrcode as $qr)
        {!! $qr->generateQRCode() !!}
        @endforeach


        </div>
</div>
