<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $basics['name'] ?? '' }} - {{ $basics['label'] ?? '' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .card {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
        }

        /* UPDATED card header style */
        .card-header {
            background-color: #f8f9fa; /* light neutral gray */
            color: #212529; /* dark gray text */
            border-bottom: 2px solid #dee2e6;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            font-size: 1.25rem;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        /* For headers that are marked as primary (Work Experience) */
        .card-header.bg-primary {
            background-color: #0d6efd; /* Bootstrap primary blue */
            color: white;
            border-bottom: 3px solid #084298; /* darker blue underline */
        }

        /* Profile card header: larger name + smaller label styling */
        .card-header h2 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.1rem;
            color: #0d2149; /* slightly darker for name */
        }

        .card-header h5 {
            font-weight: 500;
            font-size: 1.1rem;
            color: #495057; /* medium gray for subtitle */
        }

        /* Nested card inside Work Experience & Education */
        .nested-card {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
            padding: 0;
            overflow: hidden;
        }

        .nested-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .nested-card .job-header,
        .nested-card .edu-header {
            background-color: #e9ecef; /* lighter gray */
            border-bottom: 1px solid #ced4da; /* subtle border */
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.75rem 1.25rem;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            color: #212529; /* dark text for readability */
        }

        .job-date, .edu-date {
            font-size: 0.875rem;
            color: #6c757d; /* muted gray */
        }

        .job-body, .edu-body {
            padding: 1rem 1.25rem;
            font-size: 1rem;
            color: #495057;
        }

        .job-highlights {
            margin-top: 0.5rem;
            padding-left: 1.25rem;
        }

        /* Other general tweaks */
        h5, h4 {
            margin-bottom: 0.3rem;
            margin-top: 0.3rem;
        }

        p, ul {
            margin-bottom: 0.3rem;
        }

        ul {
            padding-left: 1.25rem;
        }

        a {
            text-decoration: underline;
            color: #0d6efd; /* consistent bootstrap blue */
        }

        .company-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;        /* crop to fill the circle */
            border-radius: 20%;   /* fully round */
            border: 1px solid #dee2e6; /* subtle border */
            background: white;
            padding: 2px;
        }


        .profile-img {
            max-width: 120px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container py-4">

    <!-- Basics Section -->
    <div class="card">
        <div class="card-header">
            <h2 class="mb-1">{{ $basics['name'] ?? '' }}</h2>
            <h5 class="mb-0">{{ $basics['label'] ?? '' }}</h5>
        </div>
        <div class="card-body d-flex align-items-center flex-wrap gap-3">
            @if(!empty($basics['image']))
                <img src="{{ $basics['image'] }}" alt="Profile Image" class="profile-img me-3">
            @endif
            <div>
                @if(!empty($basics['email']))
                    <p><strong>Email:</strong> <a href="mailto:{{ $basics['email'] }}">{{ $basics['email'] }}</a></p>
                @endif
                @if(!empty($basics['phone']))
                    <p><strong>Phone:</strong> <a href="tel:{{ $basics['phone'] }}">{{ $basics['phone'] }}</a></p>
                @endif
                @if(!empty($basics['website']))
                    <p><strong>Website:</strong> <a href="{{ $basics['website'] }}" target="_blank" rel="noopener noreferrer">{{ $basics['website'] }}</a></p>
                @endif
                @if(!empty($basics['url']))
                    <p><strong>LinkedIn:</strong> <a href="{{ $basics['url'] }}" target="_blank" rel="noopener noreferrer">{{ $basics['url'] }}</a></p>
                @endif
                @if(!empty($basics['location']))
                    <p><strong>Location:</strong>
                        {{ $basics['location']['address'] ?? '' }},
                        {{ $basics['location']['city'] ?? '' }},
                        {{ $basics['location']['region'] ?? '' }},
                        {{ $basics['location']['countryCode'] ?? '' }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Summary Section -->
    @if(!empty($basics['summary']))
        <div class="card">
            <div class="card-header"><h4>Summary</h4></div>
            <div class="card-body">
                <p>{{ $basics['summary'] }}</p>
            </div>
        </div>
    @endif

    <!-- Skills Section -->
    @if(!empty($skills))
        <div class="card">
            <div class="card-header"><h4>Skills</h4></div>
            <div class="card-body">
                <ul>
                    @foreach($skills as $skill)
                        <li><strong>{{ $skill['name'] }}</strong>: {{ implode(', ', $skill['keywords']) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Languages Section -->
    @if(!empty($languages))
        <div class="card">
            <div class="card-header"><h4>Languages</h4></div>
            <div class="card-body">
                <ul>
                    @foreach($languages as $lang)
                        <li>{{ $lang['language'] }} - <em>{{ ucfirst($lang['fluency']) }}</em></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Work Experience Section -->
    @if(!empty($work))
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Work Experience</h4>
            </div>
            <div class="card-body">
                @foreach($work as $job)
                    <div class="nested-card mb-4">
                        <div class="job-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                @if(!empty($job['logo']))
                                    <img src="{{ $job['logo'] }}" alt="{{ $job['name'] }} logo" class="company-logo">
                                @endif
                                <div>
                                    {{ $job['position'] ?? '' }} at {{ $job['name'] ?? '' }}
                                </div>
                            </div>
                            <div class="job-date">
                                {{ \Carbon\Carbon::parse($job['startDate'])->format('M Y') ?? '' }} -
                                {{ $job['endDate'] ? \Carbon\Carbon::parse($job['endDate'])->format('M Y') : 'Present' }}
                            </div>
                        </div>
                        <div class="job-body">
                            <p>{{ $job['summary'] ?? '' }}</p>
                            @if(!empty($job['highlights']))
                                <ul class="job-highlights list-disc list-inside">
                                    @foreach($job['highlights'] as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @endif

    <!-- Education Section -->
    @if(!empty($education))
        <div class="card">
            <div class="card-header"><h4>Education</h4></div>
            <div class="card-body">
                @foreach($education as $edu)
                    <div class="nested-card mb-4">
                        <div class="edu-header d-flex justify-content-between align-items-center">
                            <div>{{ $edu['institution'] ?? '' }}</div>
                            <div class="edu-date">
                                {{ \Carbon\Carbon::parse($edu['startDate'])->format('Y') ?? '' }} -
                                {{ $edu['endDate'] ? \Carbon\Carbon::parse($edu['endDate'])->format('Y') : 'Present' }}
                            </div>
                        </div>
                        <div class="edu-body">
                            <h5>{{ $edu['studyType'] ?? '' }} in {{ $edu['area'] ?? '' }}</h5>
                            @if(!empty($edu['score']))
                                <p><strong>Grade:</strong> {{ $edu['score'] }}</p>
                            @endif
                            @if(!empty($edu['courses']))
                                <p><strong>Courses:</strong> {{ implode(', ', $edu['courses']) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Projects Section -->
    @if(!empty($projects))
        <div class="card">
            <div class="card-header"><h4>Projects</h4></div>
            <div class="card-body">
                @foreach($projects as $project)
                    <div>
                        <h5>{{ $project['name'] ?? '' }}</h5>
                        <p class="mb-1">{{ $project['description'] ?? '' }}</p>
                        @if(!empty($project['highlights']))
                            <ul>
                                @foreach($project['highlights'] as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if(!empty($project['keywords']))
                            <p class="mb-1"><strong>Technologies:</strong> {{ implode(', ', $project['keywords']) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Certificates Section -->
    @if(!empty($certificates))
        <div class="card">
            <div class="card-header"><h4>Certificates</h4></div>
            <div class="card-body">
                <ul>
                    @foreach($certificates as $cert)
                        <li>
                            <strong>{{ $cert['name'] ?? '' }}</strong> - {{ $cert['issuer'] ?? '' }}
                            @if(!empty($cert['url']))
                                (<a href="{{ $cert['url'] }}" target="_blank" rel="noopener noreferrer">View Certificate</a>)
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

</div>
</body>
</html>
