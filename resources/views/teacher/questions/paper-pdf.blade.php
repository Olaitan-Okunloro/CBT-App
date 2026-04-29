<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
            margin: 30px;
            color: #000;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo {
            height: 70px;
        }

        .school {
            font-size: 22px;
            font-weight: bold;
        }

        .sub {
            font-size: 13px;
        }

        .meta {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .meta td {
            padding: 4px 0;
        }

        .box {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 15px;
        }

        .question {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .option {
            margin-left: 25px;
            margin-top: 3px;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 18%;
            font-size: 70px;
            color: #ddd;
            transform: rotate(-30deg);
            opacity: 0.25;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="watermark">
        CONFIDENTIAL
    </div>

    {{-- HEADER --}}
    <div class="header">
        @if(!empty($school->logo))
            <img src="{{ public_path('storage/logo/'.$school->logo) }}"
                 class="logo">
        @endif

        <div class="school">
            {{ $school->name }}
        </div>

        <div class="sub">
            {{ $school->address }}
        </div>

        <div class="sub">
            END OF TERM EXAMINATION
        </div>
    </div>

    {{-- META --}}
    <table class="meta">
        <tr>
            <td>
                <strong>Subject:</strong> {{ $subject }}
            </td>
            <td align="right">
                <strong>Class:</strong> {{ $class }}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Session:</strong>
                {{ date('Y') }}/{{ date('Y')+1 }}
            </td>
            <td align="right">
                <strong>Time:</strong> 1 Hour
            </td>
        </tr>
        <tr>
            <td>
                <strong>Name:</strong> __________________
            </td>
            <td align="right">
                <strong>Reg No:</strong> __________
            </td>
        </tr>
    </table>

    {{-- INSTRUCTION --}}
    <div class="box">
        <strong>Instructions:</strong>
        Answer all questions.
        Choose the correct option where applicable.
        Write neatly and clearly.
    </div>

    {{-- QUESTIONS --}}
    @foreach($rows as $index => $row)
        <div class="question">
            <strong>
                {{ $index + 1 }}.
            </strong>

            {{ $row->question_text }}

            @if($row->question_type == 'objective')
                @foreach($row->options as $opt)
                    <div class="option">
                        ({{ $opt->option_label }})
                        {{ $opt->option_text }}
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach

    {{-- SIGNATURE --}}
    <div style="margin-top:40px; text-align:right;">
        @if(auth()->user()->signature)
            <img src="{{ public_path('storage/signatures/' . auth()->user()->signature) }}"
                 height="55">
        @endif

        <div>
            ___________________
        </div>

        <div>
            Class Teacher
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Generated from School CBT System
    </div>
</body>
</html>