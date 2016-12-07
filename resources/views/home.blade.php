@extends('layouts.app')

@section('title')
    {{ trans('settings.title_homepage') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-2 wrapper-information-user">
            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNThkM2FiN2M5NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OGQzYWI3Yzk0Ij48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjc1NzgxMjUiIHk9Ijc0LjM5Njg3NSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" alt="Avatar" class="img-circle img-responsive">
            <p class="text-center" class="name-user">Vo Tuan Thanh</p>

            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">14</span>
                    {{ trans('settings.text.learned_words') }}
                </li>
                <li class="list-group-item">
                    <span class="badge">14</span>
                    {{ trans('settings.text.learned_categories') }}
                </li>
                <li class="list-group-item">
                    <span class="badge">14</span>
                    {{ trans('settings.text.learned_followers') }}
                </li>
            </ul>
        </div>
            
        <div class="col col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('settings.text.history_activities') }}</div>
                <div class="panel-body">
                    <div class="section-history">
                        <p>20/02/2016</p>
                        <ul>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                            <li>
                                <p>{{ trans('settings.text.learned') }} 1 {{ trans('settings.text.words_in_category') }} "qui"</p>
                            </li>
                        </ul>
                    </div>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
              <!--END BODY PANEL -->
            </div>
        </div>
    </div>
</div>
@endsection
