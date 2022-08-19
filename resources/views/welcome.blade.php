<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Final Work" />
    <meta name="author" content="Michiel Hennion" />
    <title>Predicting PC Performance</title>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ URL::asset('css\styles.css') }}" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Predicting PC Performance</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Calculator</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">How to use</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">FAQ</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">pc</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0"></p>
    </div>
</header>
<!-- Portfolio Section-->
<br>
<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">PC Performance Calculator</h2>
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <div class="row">
                <form style="width: 100%" action="{{ route('predict') }}" method="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="col">
                        <label>CPU</label>
                        <select name="cpu" id="cpu" class="form-control select2" onchange="f('cpu')">
                            @foreach($data['cpu'] as $cpu)

                                <option value="{{$cpu['Socket']}}">
                                    {{$cpu['CPU']}}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="selectedCPU" name="selectedCPU" value="{{$data['cpu'][0]['CPU']}}">
                    </div>
                    <div class="col">
                        <label>Motherboard</label>
                        <select id="motherboard" name="motherboard" class="form-control select2">
                            @foreach($data['motherboard'] as $motherboard)
                                <option>{{$motherboard['Motherboard']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>RAM</label>
                        <select name="ram" class="form-control select2">
                            <option>16GB</option>
                            <option>8GB</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>GPU</label>
                        <select name="gpu" class="form-control select2">
                            @foreach($data['gpu'] as $gpu)
                                <option>{{$gpu['GPU']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Predict PC performance</button>
                    </div>
                </form>
        </div>
        <br>
        <div class="row">
            <!-- Footer Location-->
            <div class="col">
                <div class="row">
                    @if(!empty($response))
                        <h3 class="lead">Performance:  {{round((float)$response, 2)}}</h3>

                        <div class="row">
                            <div class="col fpscontainer">
                                <div class="top-left"><b>{{round((float)$csgo, 2)}} average fps 1080p highest settings</b></div>
                                <br>
                                <br>
                                <img  src="{{ asset('img/csgo.png') }}" alt="Snow" style="width:80%;">
                            </div>
                            <div class="col fpscontainer">
                                <div class="top-left"><b>{{round((float)$overwatch, 2)}} average fps 1080p highest settings</b></div>
                                <br>
                                <br>
                                <img  src="{{ asset('img/overwatch.png') }}" alt="Snow" style="width:45%;">

                            </div>
                        </div>
                    <br>
                        <div class="row">
                            <div class="col fpscontainer">
                                <div class="top-left"><b>{{round((float)$pubg, 2)}} average fps 1080p highest settings</b></div>
                                <br>
                                <br>
                                <img  src="{{ asset('img/pubg.png') }}" alt="Snow" style="width:75%;">

                            </div>
                            <div class="col fpscontainer">
                                <div class="top-left"><b>{{round((float)$fortnite, 2)}} average fps 1080p highest settings</b></div>
                                <br>
                                <br>
                                <img  src="{{ asset('img/fortnite.png') }}" alt="Snow" style="width:60%;">

                            </div>
                        </div>
                    <br>
                        <div class="row">
                            <div class="col fpscontainer">
                                <div class="top-left"><b>{{round((float)$gtav, 2)}} average fps 1080p highest settings</b></div>
                                <br>
                                <br>
                                <img  src="{{ asset('img/gtav.png') }}" alt="Snow" style="width:75%;">
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    @if(!empty($request))
                        <h3 class="lead">Suggestions:</h3>
                        <form method="post" action="{{ route('suggestion') }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="suggestionGpu" value="{{$request->gpu}}">
                            <input type="hidden" name="suggestionCpu" value="{{$request->selectedCPU}}">
                            <input type="hidden" name="suggestionMotherboard" value="{{$request->motherboard}}">
                            <input type="hidden" name="scoreResponse" value="{{$response}}">
                            <button class="btn btn-primary" type="submit">Get Suggestions</button>
                        </form>
                    @endif
                    @if(!empty($suggestionsCpu))
                            <h3 class="lead">CPU Suggestions:</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">CPU</th>
                                    <th scope="col">Performance Increase</th>
                                </tr>
                                </thead>
                                <tbody>
                        @foreach($suggestionsCpu as $cpu)
                            <tr>
                                <td>{{$cpu[0]}}</td>
                                <td>{{$cpu[1]}}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                            </table>
                    @endif
                    @if(!empty($suggestionsGpu))
                            <h3 class="lead">GPU Suggestions:</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">GPU</th>
                                    <th scope="col">Performance Increase</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($suggestionsGpu as $gpu)
                                <tr>
                                    <td>{{$gpu[0]}}</td>
                                    <td>{{$gpu[1]}}%</td>
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">How to use</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-4 ml-auto"><p class="lead">Feel free to watch the explination video if you don't know how to use the application</p></div>
            <div class="col-lg-4 mr-auto"><p class="lead">If you have any other question, you can check out the FAQ or contact us</p></div>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Uf1TePhUhG8" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

    </div>
</section>
<!-- Contact Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">FAQ</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <br>
                        <h6>Will this project receive updates?</h6>
                        <p>There are still many ideas that are not implemented with the main reason being a lack of data. If a more complete data set becomes avaible, the project can be upgraded.</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <br>
                        <h6>Am I able to contribute to the project?</h6>
                        <p>At this moment the only way to contribute is by running Unigine's <a href="https://benchmark.unigine.com/superposition">Superposition</a> benchmark and adding your benchmark results to the scoreboard.</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <br>
                        <h6>How is it possible to predict the performance of a PC?</h6>
                        <p>Mulitple AI models were used in this project to predict the most accurate results.</p>
                    </div>
                </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <br>
                            <h6>What data was used to train the AI model?</h6>
                            <p>Unigine was so kind to allow the use of the <a href="https://benchmark.unigine.com/leaderboards/superposition/1.x/1080p-extreme/single-gpu/page-1">superstition benchmark</a> leaderboard as a data source for my thesis.</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    Belgium
                    <br />
                    Erasmus hogeschool Brussel
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Social</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About project</h4>
                <p class="lead mb-0">
                    This project was made as a thesis by a student of applied informatics, and expended upon for the course Software Security.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright © The Dark Side EhB 2021</small></div>
</div>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script>
    function f(origin) {
        var data = @json($data);
        var cpuSocket = document.getElementById('cpu').value;

        var sel = document.getElementById("cpu");
        console.log(sel.options[sel.selectedIndex].text)
        document.getElementById('selectedCPU').value = sel.options[sel.selectedIndex].text

        if (origin == 'cpu') {
            var motherboards = data.motherboard;
            var x = document.getElementById("motherboard").value;
            var str = ""
            for (var motherboard of motherboards) {
                if(motherboard.Socket == cpuSocket) {
                    str += "<option>" + motherboard.Motherboard + "</option>"
                }
            }
            document.getElementById("motherboard").innerHTML = str;
        }

        if (origin == 'motherboard') {
            var cpus = data.cpu;
            var x = document.getElementById("cpu").value;
            var str = ""
            for (var cpu of cpus) {
                if(cpu.Socket == motherboardSocket) {
                    str += "<option>" + motherboard.motherboard + "</option>"
                }
            }
            document.getElementById("cpu").innerHTML = str;
        }
    }
</script>
</body>
</html>
