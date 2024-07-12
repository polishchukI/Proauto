<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('inventory.provider_price_import_progress') }}</h4>
            </div>
            <div class="card-body">
                <div class="progress-container">
                    <span class="progress-badge">0%</span>
                    <div class="progress">
                        <div class="progress-bar" id="progressBar" role="progressBar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script defer>
const progressBar = document.getElementById("progressBar");
let currentProgress = 0;

function increaseProgress()
{
    if (currentProgress < 100)
    {
        currentProgress += 5;
        progressBar.style.width = currentProgress + "px";
    }
}
</script>
@endpush