<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <main class="main_section">
        <style>
            .breaking_news_wrap {
                padding: 12px 20px 8px;
                font-size: 16px;
                color: #444;
            }
            .breaking_news_label {
                padding: 0 17px;
                background: #431c46;
                font-size: 15px;
                color: #fff;
                text-shadow: 0 1px 2px #431c46;
                cursor: default;
            }
            .filterNav {
                overflow: hidden;
                border-bottom: 1px solid #333;
            }

            .filterNav a {
                float: left;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
                color: #431c46;
            }

            .filterNav a:hover {
                background-color: #f5f5f5;
                color: black;
            }

            .filterNav a.active {
                background-color: #8cc63f;
                color: white;
            }
        </style>
        <div class="container">
            <div class="d-flex">
                <div class="breaking_news_label">
                    Breaking News: 
                </div>
                <div class="js-conveyor-example flex-grow-1">
                    <ul>
                      <li>
                        <span class="mt-2">{{ $breaking_news->description }}</span>
                      </li>
                    </ul>
                </div>
                <script defer>
                    $('.js-conveyor-example').jConveyorTicker({
                        anim_duration: 200,
                        reverse_elm: true,
                        force_loop: true,
                    });
                </script>
            </div>
        </div>
        @livewire('components.banner')
        @include('livewire.components.branch', [
            'branches' => $branches,
        ])
        @livewire('components.news-events')
        @livewire('components.course')
        @livewire('components.stats')
        @livewire('components.lecturer')
        <section class="class_schedule_area">
            <div class="container">
                <div class="class_schedule_title">
                    <h2>class schedule</h2>
                </div>
                <div class="filterNav mb-3">
                    @foreach ($branches as $key => $item)
                        <a @if($key == 0) class="active" @endif id="filter_nav{{$item->id}}" onclick="get_class_schedules({{ $item->id }})" href="javascript:void(0)">{{ $item->name }}</a>
                    @endforeach
                </div>
                <div class="class_schedule_content" id="total_routine">

                </div>
                
            </div>
        </section>
    </main>
    @push('custom-scripts')
        <script type="text/javascript" src="/js/custom.js"></script>
    @endpush
</div>
