<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="sidebar-sticky mt-5">
                <ul class="nav flex-column">
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="apprentisDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Apprentis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="apprentisDropdown">
                            <a class="dropdown-item" href="{{ route('apprentis.index')}}">Ajouter</a>
                            <a class="dropdown-item" href=" {{ route('apprentis.consulter') }}">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="maitresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Maîtres apprentis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="maitresDropdown">
                            <a class="dropdown-item" href="{{ route('maitreapprentis.index') }}">Ajouter</a>
                            <a class="dropdown-item" href="#">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="structuresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Structures
                        </a>
                        <div class="dropdown-menu" aria-labelledby="structuresDropdown">
                            <a class="dropdown-item" href="{{ route('structures.index') }}">Ajout & Deatils</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="exercicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            exercices
                        </a>
                        <div class="dropdown-menu" aria-labelledby="exercicesDropdown">
                            <a class="dropdown-item" href="#">Ajouter</a>
                            <a class="dropdown-item" href="#">Consulter la liste</a>
                        </div>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="plansDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Plans de besoins
                        </a>
                        <div class="dropdown-menu" aria-labelledby="plansDropdown">
                            <a class="dropdown-item" href="#">Ajouter un plan</a>
                            <a class="dropdown-item" href="#">Consulter les plans</a>
                            @if ($user->role === 'DFP')
                            <a class="dropdown-item" href="#">Details des plans</a>
                            @endif
                        </div>
                    </li>
                    @if ($user->role == 'DRH')
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="parametresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Parametres
                        </a>
                        <div class="dropdown-menu" aria-labelledby="parametresDropdown">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                            <a class="dropdown-item" href="#">Link 3</a>
                        </div>
                    </li>
                    @endif
                    @if ($user->role == 'SA' || $user->role == 'DFP')
                    <li class="nav-item mb-5">
                        <a class="nav-link dropdown-toggle" href="#" id="comptesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Comptes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="comptesDropdown">
                            @if ($user->role == "DFP")
                            <a class="dropdown-item" href="#">Ajouter des comptes</a>
                            @endif
                            <a class="dropdown-item" href="#">Consulter les comptes</a>
                        </div>
                    </li>
                    @endif
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