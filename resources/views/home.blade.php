@extends('layouts.app')
@section('content')
    <!--banner圖片  startr-->
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($carousels as $carousel)
                    @if($loop->index==0)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{$loop->index}}" class="active"
                                aria-label="Slide {{($loop->index)+1}}"></button>
                    @else
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{$loop->index}}" aria-label="Slide {{($loop->index)+1}}"></button>
                    @endif
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($carousels as $carousel)
                    @if($loop->index==0)
                        <div class="carousel-item active">
                            <img src="{{asset("storage/uploads/images/".$carousel->image_url)}}" class="d-block w-100"
                                 alt="...">
                            @else
                                <div class="carousel-item">
                                    <img src="{{asset("storage/uploads/images/".$carousel->image_url)}}"
                                         class="d-block w-100" alt="...">
                                    @endif
                                </div>
                                @endforeach

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($plates as $plate)
                    <div class="col-sm-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset("storage/uploads/images/".$plate->image_url)}}" class="card-img-top"
                                 alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$plate->name}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            {{$plates->links() }}
        </div>
@endsection
