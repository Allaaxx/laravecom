@extends('back.layout.dashboard-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Shop Settings</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Shop Settings
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <x-alert.form-alert />
            <form action="{{ route('seller.shop-setup') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shop_name"><b>Nome da Loja :</b></label>
                            <input id="shop_name" class="form-control" type="text" name="shop_name"
                                placeholder="Digite o nome da sua loja aqui..."
                                value="{{ old('shop_name', $shopInfo->shop_name) }}">
                            @error('shop_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="shop_phone"><b>Telefone da Loja:</b></label>
                            <input id="shop_phone" class="form-control" type="text" name="shop_phone"
                                placeholder="eg:+1 234 567 890" value="{{ old('shop_phone', $shopInfo->shop_phone) }}">
                            @error('shop_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="shop_address"><b>Endereço da Loja:</b></label>
                            <input id="shop_address" class="form-control" type="text" name="shop_address"
                                placeholder="eg: 1234 Main St, City, Country"
                                value="{{ old('shop_address', $shopInfo->shop_address) }}">
                            @error('shop_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="shop_description"><b>Descrição da Loja:</b></label>
                            <textarea id="shop_description" class="form-control" name="shop_description" cols="30" rows="10"
                                placeholder="Digite uma breve descrição da sua loja aqui...">{{ old('shop_description', $shopInfo->shop_description) }}</textarea>
                            @error('shop_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="shop_logo"><b>Logo da Loja: </b></label>
                            <div class="mb-2 mt-1" style="max-width:200px">
                                <a href="javascript:;"
                                    onclick="event.preventDefault(); document.getElementById('shop_logo').click();"
                                    class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                <img src="{{ $shopInfo->shop_logo ? '/images/shop/' . $shopInfo->shop_logo : '/images/shop/default_logo.svg' }}"
                                    alt="Shop Logo" class="img-thumbnail" id="shop_logo_preview">
                                <input type="file" name="shop_logo" id="shop_logo" class="d-none" style="opacity: 0">
                            </div>
                            @error('shop_logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="boxed-btn">Atualizar</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[type="file"][name="shop_logo"]').ijaboViewer({
                preview: "img#shop_logo_preview",
                imageShape: "square",
                allowedExtensions: ['jpg', 'svg', 'png'],
                onErrorShape: function(message, element) {
                    alert(message);
                },
                onInvalidType: function(message, element) {
                    alert(message);
                },
                onSuccess: function(message, element) {}
            });
        });
    </script>
@endpush
