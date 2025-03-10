<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-body">
                <div class="space-y-indent-half">
                    @include("rf::admin.forms.call-includes.search")
                    <x-tt::notifications.error />
                    <x-tt::notifications.success />
                </div>
            </div>

            @include("rf::admin.forms.call-includes.table")
            @include("rf::admin.forms.includes.delete-modal")
        </div>
    </div>
</div>
