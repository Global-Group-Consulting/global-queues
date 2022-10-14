@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <ul class="nav mb-4 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active text-warning" aria-current="page" href="{{route('jobList.create', ['clone' => $job->id])}}">
            <i class="fas fa-copy"></i>
            Clona
          </a>
        </li>
      </ul>

      <div class="card ">
        <div class="card-header">{{ __('Modifica Job') }}</div>

        <div class="card-body">
          <form action="{{ route('jobList.update', $job->id)  }}" method="POST">
            @csrf
            @method("patch")

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Titolo",
                  "name" => "title",
                  "value" => $job["title"]
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => $job["description"]
                ])
              </div>
            </div>

            <div class="row">
              <div class="col">
                @include("partials.form_select", [
                  "label" => "Classe",
                  "name" => "class",
                  "value" => $job["class"],
                  "options" => $availableClasses
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Nome Queue",
                  "name" => "queueName",
                  "value" => $job["queueName"]
                ])
              </div>
            </div>

            <fieldset class="mt-3">
              <legend>Payload</legend>
              <div class="row">
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Nome variabile Payload",
                    "name" => "payloadKey",
                    "value" => $job["payloadKey"]
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Validazione Payload",
                    "name" => "payloadValidation",
                    "value" => $job["payloadValidation"]
                  ])
                </div>
              </div>
            </fieldset>

            <fieldset class="mt-3">
              <legend>API</legend>
              <div class="row">
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Url",
                    "name" => "apiUrl",
                    "value" => $job["apiUrl"]
                  ])
                </div>
                <div class="col">
                  @include("partials.form_select", [
                    "label" => "Metodo",
                    "name" => "apiMethod",
                    "value" => $job["apiMethod"],
                    "options" => [
                      [
                        "text" => "-",
                        "value" => "",
                      ], [
                        "text" => "GET",
                        "value" => "get",
                      ], [
                        "text" => "POST",
                        "value" => "post",
                      ], [
                        "text" => "PUT",
                        "value" => "put",
                      ], [
                        "text" => "PATCH",
                        "value" => "patch",
                      ]
                    ]
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Headers",
                    "name" => "apiHeaders",
                    "value" => $job["apiHeaders"]
                  ])
                </div>
              </div>
            </fieldset>

            <fieldset class="mt-3">
              <legend>Autenticazione</legend>
              <div class="row">
                <div class="col">
                  @include("partials.form_select", [
                    "label" => "Tipologia",
                    "name" => "authType",
                    "value" => $job["authType"],
                    "options" => [
                      [
                        "text" => "-",
                        "value" => "",
                      ],
                      [
                        "text" => "Basic",
                        "value" => "Basic",
                      ]
                    ]
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Username",
                    "name" => "authUsername",
                    "value" => $job["authUsername"]
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Password",
                    "name" => "authPassword",
                    "value" => $job["authPassword"]
                  ])
                </div>
              </div>
            </fieldset>

            <div class=" d-flex">
              <a href="{{route('jobList.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Salva</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
