@extends('layouts.home')

@section('container')
<div id="big-screen">
    <div class="clearfix"></div>
    <div id="particles-js"></div>
    <h1 class="text-center">知识改变命运，技术改变生活</h1>
</div>
<div class="container cuojues">
    <hr class="hr-text" data-content="人生三大错觉">
    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>这东西特么的好简单啊</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>这东西练一遍就会了</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>我太帅了</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-text" data-content="复杂的事情简单做，简单的事情重复做，重复的事情用心做">
</div>
@stop


@section('title', '首页')

@section('js')
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 100,
                "density": {
                    "enable": true,
                    "value_area": 700
                }
            },
            "color": {
                "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 15
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1.5,
                    "opacity_min": 0.15,
                    "sync": false
                }
            },
            "size": {
                "value": 2.5,
                "random": false,
                "anim": {
                    "enable": true,
                    "speed": 2,
                    "size_min": 0.15,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 110,
                "color": "#33b1f8",
                "opacity": 0.25,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1.6,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "bounce",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": false,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
</script>

@stop

@section('css')
    <link rel="stylesheet" href="/css/particles.css">
@stop

@section('search')
@stop