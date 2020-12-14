<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Dear all, <br>
    You are invited to this kaizen:
    <p>---------------------------------------------------------------------------</p>
    <table>
        <tr>
            <td>Title</td>
            <td>:</td>
            <td>{{$main->Kaizen_title}}</td>
        </tr>
        <tr>
            <td>Type</td>
            <td>:</td>
            <td>{{$main->Kaizen_type}}</td>
        </tr>
        <tr>
            <td>Department</td>
            <td>:</td>
            <td>{{$main->Kaizen_dept}}</td>
        </tr>
        <tr>
            <td>Members</td>
            <td>:</td>
            <td>{{count($member)}}</td>
        </tr>
        <tr>
            <td>Duration</td>
            <td>:</td>
            <td>
                @php
                    $fdate = $date->Kaizen_DateFrom;
                    $tdate = $date->Kaizen_DateTo;

                    $datetime1 = new DateTime($fdate);
                    $datetime2 = new DateTime($tdate);
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format('%a');
                @endphp
                {{$days+1}}days
            </td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td>:</td>
            <td>{{$date->Kaizen_DateFrom}}</td>
        </tr>
        <tr>
            <td>End Date</td>
            <td>:</td>
            <td>{{$date->Kaizen_DateTo}}</td>
        </tr>
    </table>
    <br>
    <p>List of members:</p>
    <table>
        @foreach($member as $mem)
            <tr>
                <td>- {{ $mem->member_roles }}</td>
                <td>:</td>
                <td>{{ $mem->Fullname }}</td>
                <td>({{ $mem->kpkNum }})</td>
            </tr>
        @endforeach
    </table>
    <table>
    Scope:
        @foreach($Scope as $list)
            <tr>
                <td>
                    <ul>
                        <li>{{ $list->scope }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <table>
    Background:
        @foreach($Back as $list)
            <tr>
                <td>
                    <ul>
                        <li>{{ $list->background }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <table>
    Baseline:
        @foreach($Base as $list)
            <tr>
                <td>
                    <ul>
                        <li>{{ $list->baseline }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <table>
    Baseline:
        @foreach($Goals as $list)
            <tr>
                <td>
                    <ul>
                        <li>{{ $list->goals }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
    <table>
    Deliverables:
        @foreach($Deliv as $list)
            <tr>
                <td>
                    <ul>
                        <li>{{ $list->deliverable }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>

    <p>---------------------------------------------------------------------------</p>
    <p>Thank You</p>
    
</body>
</html>