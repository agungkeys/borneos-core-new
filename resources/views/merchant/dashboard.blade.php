@extends('layouts.app-merchant')

@section('content')
    <div class="app-main__inner p-0">
        <div class="app-inner-layout chat-layout">
            <div class="app-inner-layout__header text-white bg-premium-dark">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon p-0">
                                <img src="{{ $merchant[0]->logo }}" class="w-100 rounded" />
                            </div>
                            <div>{{ $merchant[0]->name }}<div class="page-title-subheading">Halo,
                                    <b>{{ Auth()->user()->f_name }} {{ Auth()->user()->l_name }}</b> anda terdaftar
                                    menggunakan email {{ Auth()->user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions">
                            <button type="button" class="btn-shadow btn btn-warning align-middle justify-center">
                                <i class="metismenu-icon pe-7s-call"></i> Hubungi Admin Borneos
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-4 mt-4">
                <div class="tabs-animation">
                    <div class="row">
                        <div class="col-lg-12 col-xl-6">
                            <div class="main-card mb-3 card">
                                <div class="grid-menu grid-menu-2col">
                                    <div class="no-gutters row">

                                        <div class="col-sm-6">
                                            <div class="widget-chart widget-chart-hover">
                                                <div class="icon-wrapper rounded-circle">
                                                    <div class="icon-wrapper-bg bg-info"></div><i
                                                        class="lnr-layers text-info"></i>
                                                </div>
                                                <div class="widget-numbers">{{ $productCount }}</div>
                                                <div class="widget-subheading">Total Produtcs</div>
                                                <div class="widget-description text-info">
                                                    <span class="pl-1"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="widget-chart widget-chart-hover">
                                                <div class="icon-wrapper rounded-circle">
                                                    <div class="icon-wrapper-bg bg-danger"></div><i
                                                        class=" lnr-chart-bars text-danger"></i>
                                                </div>
                                                <div class="widget-numbers">{{ $orderCount->today }}</div>
                                                <div class="widget-subheading">Total Orders Today</div>
                                                <div class="widget-description text-primary">
                                                    <span class="pr-1"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="widget-chart widget-chart-hover br-br">
                                                <div class="icon-wrapper rounded-circle">
                                                    <div class="icon-wrapper-bg bg-success"></div><i
                                                        class="lnr-pie-chart"></i>
                                                </div>
                                                <div class="widget-numbers">{{ $orderCount->all }}</div>
                                                <div class="widget-subheading">Total Orders</div>
                                                <div class="widget-description text-warning">
                                                    <span class="pr-1"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="widget-chart widget-chart-hover">
                                                <div class="col-sm-6" style="height: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
