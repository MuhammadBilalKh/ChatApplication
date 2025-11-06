@extends('layout.master.main')

@section('title', 'Games')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => 'Games'])
@endsection

@section('dashboard-content')
    <article id="post-602" class="post-602 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <div data-kmk-type="wp-page" data-kmk-id="602" class="kmk kmk-602" data-kmk-post-type="page">
                <div class="kmk-element kmk-element-e9eda91 e-flex e-con-boxed e-con e-parent" data-id="e9eda91"
                    data-element_type="container">
                    <div class="e-con-inner">
                        <div class="kmk-element kmk-element-a4f3318 kmk-widget kmk-widget-html" data-id="a4f3318"
                            data-element_type="widget" data-widget_type="html.default">
                            <iframe name="game" width="1000" height="1000" src="https://porkgames.com/"
                                scrolling="yes" marginwidth="0" marginheight="0"
                                style="border: 0; overflow: auto;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
