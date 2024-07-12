@extends('inventory.layouts.app', ['pageSlug' => 'phpinfo', 'page' => 'phpinfo', 'section' => '', 'search' => ''])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('inventory.phpinfo') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                    </div>
                    </div>
                </div>
                <!------>
                <div class="card-body">
					<div class="row">
						<div class="col-12">{{phpinfo()}}</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection
