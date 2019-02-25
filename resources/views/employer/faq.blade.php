
@extends('layouts.employer')

@section('content')
  <!-- Login area-->
  <main class="job_listing_wrapper">
    <div class="job_listing_area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="job_listing_inner">
              <div class="jobl_header text-center">
                <h2>FREQUENTLY ASKED QUESTIONS</h2>
                <p>Don't See your question here? Please <a href="{{ route('employer.support.create') }}">contact our support</a> 
              </div>
              <div class="listing_box faqquestions">
                <div class="panel-group" id="accordion">
                  @forelse($faqs as $faq)
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"> 
                        <a data-toggle="collapse" data-parent="#accordion" href="#faq-panel-{{ $loop->index + 1 }}">{{ $faq->question }}</a>
                      </h4>
                    </div>
                    <div id="faq-panel-{{ $loop->index + 1 }}" class="panel-collapse collapse">
                      <div class="panel-body">{{ $faq->answer }}</div>
                    </div>
                  </div>
                  @empty
                  <p class="panel">Sorry! There is nothing to show here.</p>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection