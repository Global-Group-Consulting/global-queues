@extends("layouts.app")

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <div class="card">
        <div class="card-header">{{ __('Crea un nuovo Job') }}</div>

        <div class="card-body">
          <form action="{{route("jobList.store")}}" method="POST">
            @csrf

            <div class="row">
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Titolo",
                  "name" => "title",
                  "value" => old("title")
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Descrizione",
                  "name" => "description",
                  "value" => old("description")
                ])
              </div>
            </div>

            <div class="row">
              <div class="col">
                @include("partials.form_select", [
                  "label" => "Classe",
                  "name" => "class",
                  "value" => old("class"),
                  "options" => $availableClasses
                ])
              </div>
              <div class="col">
                @include("partials.form_input", [
                  "label" => "Nome Queue",
                  "name" => "queueName",
                  "value" => old("queueName"),
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
                    "value" => old("payloadKey") ?? "data",
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Validazione Payload",
                    "name" => "payloadValidation",
                    "value" => old("payloadValidation"),
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
                    "value" => old("apiUrl"),
                  ])
                </div>
                <div class="col">
                  @include("partials.form_select", [
                    "label" => "Metodo",
                    "name" => "apiMethod",
                    "value" => old("apiMethod"),
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
                    "value" => old("apiHeaders"),
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
                    "value" => old("authType"),
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
                    "value" => old("authUsername"),
                  ])
                </div>
                <div class="col">
                  @include("partials.form_input", [
                    "label" => "Password",
                    "name" => "authPassword",
                    "value" => old("authPassword"),
                  ])
                </div>
              </div>
            </fieldset>

            <div class=" d-flex">
              <a href="{{route('jobList.index')}}" class="btn btn-outline-secondary me-3"
                 type="reset">Annulla</a>
              <button class="btn btn-success" type="submit">Crea</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
