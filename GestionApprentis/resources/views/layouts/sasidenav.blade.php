<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="sidebar-sticky mt-5">
            <ul class="nav flex-column">
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
                            Structures
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('planbesoins.index') }}">
                            Plans de besoins
                        </a>
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
                        <a class="nav-link" href="{{ route('assiduites.index') }}">
                            Assiduites
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('departs.index') }}">
                            Departs
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ route('avenants.index') }}">
                            Avenants
                        </a>
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
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="{{ url('/profile') }}">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>