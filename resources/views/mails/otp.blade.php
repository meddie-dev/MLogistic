<div class="tw-bg-gray-100 tw-py-8 tw-px-4">
    <div class="tw-max-w-lg tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
        <div class="tw-mt-6">
            @auth
            <h1 class="tw-text-3xl tw-font-bold tw-text-gray-800">Hello,  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!</h1>
            @endauth
            <p class="tw-mt-2 tw-text-gray-600">We received a request for account verification or an important action (such as account deletion). Please use the OTP code below to proceed:</p>

            <p class="tw-mt-4 tw-text-2xl tw-font-bold tw-text-gray-800">Your OTP Code: <span class="tw-text-blue-600"><b>{{ $otp }}</b></span></p>

            <p class="tw-mt-4 tw-text-gray-600">
                This code is valid for the next <strong>10 minutes</strong>. If you didn't request this, please ignore this message or contact our support team.
            </p>

            <p class="tw-mt-4 tw-text-gray-600">
                If you have any questions, feel free to reach out to us at <a href="mailto:support@example.com" class="tw-text-blue-600 tw-underline">support@example.com</a>.
            </p>

            <p class="tw-mt-6 tw-text-gray-600">Best regards,<br><span class="tw-font-semibold">The Team</span></p>

            <div class="tw-border-t tw-mt-8 tw-pt-4">
                <p class="tw-text-center tw-text-gray-500 tw-text-sm">&copy; {{ date('Y') }} Our Service. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
