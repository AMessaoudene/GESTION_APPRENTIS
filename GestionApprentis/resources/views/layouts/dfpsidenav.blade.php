<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar" style="background-color:#007bff;">
            <div class="sidebar-sticky mt-5">
                <ul class="nav flex-column">
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('dfp.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('apprentis.consulter') }}">
                            Apprentis
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('maitreapprentis.index') }}">
                            Maîtres apprentis
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('structures.index') }}">
                            Structures d'accueil
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="EducationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Education
                        </a>
                        <div class="dropdown-menu" aria-labelledby="EducationsDropdown">
                            <a class="dropdown-item" href="{{ route('planbesoins.index') }}">Plan de besoins</a>
                            <a class="dropdown-item" href="{{ route('diplomes.index') }}">Diplomes</a>
                            <a class="dropdown-item" href="{{ route('specialites.index') }}">Specialités</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="EvaluationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Evaluations
                        </a>
                        <div class="dropdown-menu" aria-labelledby="EvaluationsDropdown">
                            <a class="dropdown-item" href="{{ route('evaluation_apprentis.index') }}">Apprentis</a>
                            <a class="dropdown-item" href="{{ route('evaluationMA.index') }}">Maitre Apprentis</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="ComportementsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Comportements
                        </a>
                        <div class="dropdown-menu" aria-labelledby="ComportementsDropdown">
                            <a class="dropdown-item" href="{{ route('departs.index') }}">Departs</a>
                            <a class="dropdown-item" href="{{ route('assiduites.index') }}">Assiduites</a>
                            <a class="dropdown-item" href="{{ route('avenants.index') }}">Avenants</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Parametres
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="{{ route('exercices.index') }}">Administratives</a>
                            <a class="dropdown-item" href="{{ route('parametres.index') }}">Legislatives</a>
                            <a class="dropdown-item" href="{{ route('baremes.index') }}">Baremes</a>
                            <a class="dropdown-item" href="{{ route('refsalariaires.index') }}">Ref. Salariales</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('comptes.index') }}">
                            Comptes
                        </a>
                    </li>
                    <!--<li class="nav-item mb-5">
                        <a class="nav-link" href="{{ url('/profile') }}">
                            Profile
                        </a>
                    </li>-->
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>