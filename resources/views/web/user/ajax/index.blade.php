@foreach($users as $user)
    <div class="col col-md-6">
        <div class="profile-user">
            <img src="{{ $user->avatarPath() }}">
            <div class="info-user" data-url-user= "{{ action('Web\UserController@ajaxRelationshipUser', [
                    'id' => $user->id,
                ]) }}" >
                <h5>{{ $user->name }}</h5>
                <ul class="info-detail">
                    <li>{{ $user->email }}</li>
                    <li>{{ trans('settings.text.user.count_following_user', [
                            'number' => $user->following->count(),
                        ]) }}
                    </li>
                    <li>{{ trans('settings.text.user.count_followers', [
                            'number' => $user->followers->count(),
                        ]) }}
                    </li>
                </ul>
                @if (auth()->user()->following->contains('id', $user->id))
                    <a class="btn btn-success action-relationship-user" href="javascript:void(0)"
                        data-trans="{{ trans('settings.text.user.follow') }}">
                        {{ trans('settings.text.user.unfollow') }}
                    </a>
                @else
                    <a class="btn btn-default action-relationship-user" href="javascript:void(0)"
                        data-trans="{{ trans('settings.text.user.unfollow') }}">
                        {{ trans('settings.text.user.follow') }}
                    </a>
                @endif
            </div>
        </div>
        <!--END: Profile -->
    </div>
@endforeach
