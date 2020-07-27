<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->

<head></head>
<body>
<div class="">
    <div class="aHl">

    </div>
    <div id=":nv" tabindex="-1">

    </div>
    <div id=":nk" class="ii gt">
        <div id=":nj" class="a3s aXjCH msg-4831759070221370014"><u></u>


            <div class="m_-4831759070221370014email-receipt"
                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;line-height:1;padding:15px;font-family:'Helvetica';font-size:14px;background:#f9fafb">
                <table class="m_-4831759070221370014block"
                       style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;background:white;border-radius:4px;padding:32px 0;border-collapse:separate;width:100%;display:table">
                    <tbody>
                    <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <div class="m_-4831759070221370014logo"
                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;text-align:left;margin-left:32px">
                                <img src="{{asset('img/logo.png')}}"
                                     style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:100px;max-width:100px;height:auto"
                                     class="CToWUd">
                            </div>
                        </td>
                    </tr>
                    <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <div class="m_-4831759070221370014block-inner m_-4831759070221370014block-message"
                                 style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:0 32px">
                                <p class="m_-4831759070221370014grey"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#6d6e70;margin:30px 0 0 0;margin-top:0">
                                    أهلا
                                    <span class="m_-4831759070221370014black m_-4831759070221370014bold"
                                          style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#000;font-weight:bold">{{$order->client->name}}</span>
                                </p>
                                <p class="m_-4831759070221370014grey"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#6d6e70;margin:30px 0 0 0">
                                    شكرا لاستخدامك بيم يوم
                                    <span class="m_-4831759070221370014black m_-4831759070221370014bold"
                                          style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#000;font-weight:bold">{{Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</span>.
                                </p>
                                <p class="m_-4831759070221370014grey"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#6d6e70;margin:30px 0 0 0;margin-bottom:30px;padding-bottom:30px;vertical-align:baseline;border-bottom:1px solid #e3e8ec">
                                    أجرة التوصيل الخاصة بك هى
                                    <span class="m_-4831759070221370014black m_-4831759070221370014bold"
                                          style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#000;font-weight:bold">{{$order->subtotal_price}} {{CURRENCY}}</span>.
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <div class="m_-4831759070221370014block-inner m_-4831759070221370014trip-route"
                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:0 32px">
                                <div class="m_-4831759070221370014trip-route-stop"
                                     style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex">
                                    <div class="m_-4831759070221370014icon"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:8px;height:8px;border-radius:6px;border:2px solid #37b44d"></div>
                                    <div class="m_-4831759070221370014title"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;font-weight:bold;margin:0 16px 0 0">
                                       نقطة الانطلاق
                                    </div>
                                    <div class="m_-4831759070221370014time"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;color:#8899a6;font-size:12px">
                                       {{Carbon\Carbon::parse($order->start_at)->format('h:mm a')}}
                                    </div>
                                </div>
                                <div class="m_-4831759070221370014trip-route-stop-address"
                                     style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#6d6e70;padding:0 22px 14px 0;border-right:2px solid #37b44d;margin:2px 5px 0 0">
                                    <div class="m_-4831759070221370014text"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:4px 0 0 0">
                                        <a href="https://maps.google.com/?ll={{$order->source_lat}},{{$order->source_long}}">{{$order->source_lat}},{{$order->source_long}}</a>
                                    </div>
                                </div>
                                <div class="m_-4831759070221370014trip-route-stop m_-4831759070221370014dropoff"
                                     style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin-top:2px">
                                    <div class="m_-4831759070221370014icon"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:8px;height:8px;border-radius:6px;border:2px solid #37b44d;background:#37b44d"></div>
                                    <div class="m_-4831759070221370014title"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;font-weight:bold;margin:0 16px 0 0">
                                        مكان الوصول
                                    </div>
                                    <div class="m_-4831759070221370014time"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;color:#8899a6;font-size:12px">
                                        {{Carbon\Carbon::parse($order->delivered_at)->format('h:mm a')}}
                                    </div>
                                </div>
                                <div class="m_-4831759070221370014trip-route-stop-address"
                                     style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#6d6e70;padding:0 22px 14px 0;border-right:2px solid #37b44d;margin:2px 5px 0 0;border-color:transparent;padding-bottom:0">
                                    <div class="m_-4831759070221370014text"
                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:4px 0 0 0">
                                        <a href="https://maps.google.com/?ll={{$order->destination_lat}},{{$order->destination_long}}">{{$order->destination_lat}},{{$order->destination_long}}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="m_-4831759070221370014block"
                       style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;background:white;border-radius:4px;padding:32px 0;border-collapse:separate;width:100%;display:table;margin:15px 0 0 0">
                    <tbody>
                    <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <table class="m_-4831759070221370014block-inner m_-4831759070221370014fare-breakdown"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;border-collapse:separate;width:100%;display:table;padding:0 32px">
                                <tbody>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <div class="m_-4831759070221370014fare-note m_-4831759070221370014fare-note-top"
                                             style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#8899a6;font-size:12px;display:flex">
                                            {{--أجرة التوصيل الخاصة بك--}}

                                            <div class="m_-4831759070221370014help-icon"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin-right:8px;margin-top:2px">
                                                {{--<a href="https://help.careem.com/hc/en-us/articles/360001400007-What-do-Starting-Waiting-Moving-and-Minimum-mean-"--}}
                                                   {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit"--}}
                                                   {{--target="_blank"--}}
                                                   {{--data-saferedirecturl="https://www.google.com/url?q=https://help.careem.com/hc/en-us/articles/360001400007-What-do-Starting-Waiting-Moving-and-Minimum-mean-&amp;source=gmail&amp;ust=1549442808817000&amp;usg=AFQjCNGc6ry-8Ycgvac-_0RX8FAVIUW4sQ">--}}
                                                    {{--<img src="https://ci4.googleusercontent.com/proxy/d6yBzwZjApI4ZuqJ6QiLn0jF6vgDAedhbeNmFlmXkfdv2dxtG8WywVQYfCAiJvuUDKSH2P0FyHjVQT28BUZcM62vmcoLEx7wi0-1uMCskeAloCjos7nxr_ihfSu7LQ=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/help_icon_arabic.png"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:16px;height:16px"--}}
                                                         {{--class="CToWUd">--}}
                                                {{--</a>--}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <div class="m_-4831759070221370014breakdown-table-container"
                                             style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:5px 0 0 0">
                                            <div class="m_-4831759070221370014breakdown-table"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:7px 0 10px 0;border-bottom:1px solid #e3e8ec;color:#606c74">

                                                {{--<div class="m_-4831759070221370014breakdown-table-row"--}}
                                                     {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">--}}
                                                    {{--<div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">--}}
                                                        {{--السعر الأساسي--}}
                                                    {{--</div>--}}
                                                    {{--<div class="m_-4831759070221370014amount"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">--}}
                                                        {{--2.60--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="m_-4831759070221370014breakdown-table-row"--}}
                                                     {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">--}}
                                                    {{--<div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">--}}
                                                        {{--سعر المسافة المستقطعة--}}
                                                    {{--</div>--}}
                                                    {{--<div class="m_-4831759070221370014amount"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">--}}
                                                        {{--2.19--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="m_-4831759070221370014breakdown-table-row"--}}
                                                     {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">--}}
                                                    {{--<div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">--}}
                                                        {{--سعر الانتظار (قبل وأثناء الرحلة)--}}
                                                    {{--</div>--}}
                                                    {{--<div class="m_-4831759070221370014amount"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">--}}
                                                        {{--7.65--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="m_-4831759070221370014breakdown-table-row"--}}
                                                     {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">--}}
                                                    {{--<div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">--}}
                                                        {{--بوابات التعريف--}}
                                                    {{--</div>--}}
                                                    {{--<div class="m_-4831759070221370014amount"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">--}}
                                                        {{--0.00--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="m_-4831759070221370014breakdown-table-row"--}}
                                                     {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">--}}
                                                    {{--<div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">--}}
                                                        {{--Offline Pricing Adjustment--}}
                                                    {{--</div>--}}
                                                    {{--<div class="m_-4831759070221370014amount"--}}
                                                         {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">--}}
                                                        {{--0.00--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="m_-4831759070221370014breakdown-table"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:7px 0 10px 0;border-bottom:1px solid #e3e8ec;color:#606c74">
                                                <div class="m_-4831759070221370014breakdown-table-row"
                                                     style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">
                                                    <div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                        إجمالى المبلغ
                                                    </div>
                                                    <div class="m_-4831759070221370014amount"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:rtl">
                                                        {{CURRENCY}} {{$order->discount_price}}

                                                    </div>
                                                </div>

                                                <div class="m_-4831759070221370014breakdown-table-row"
                                                     style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0">
                                                    <div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                        خصم الرمز الترويجي
                                                    </div>
                                                    <div class="m_-4831759070221370014amount"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">
                                                        {{CURRENCY}} {{$order->discount_price}}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m_-4831759070221370014breakdown-table"
                                                 style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;padding:7px 0 10px 0;border-bottom:1px solid #e3e8ec;color:#606c74;padding-bottom:0;border-bottom:0">
                                                <div class="m_-4831759070221370014breakdown-table-row m_-4831759070221370014breakdown-table-row-total"
                                                     style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;margin:10px 0 0 0;font-weight:bold;color:#2d2e2e">
                                                    <div style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                        الأجرة الكلية
                                                    </div>
                                                    <div class="m_-4831759070221370014amount"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin:0 auto 0 0;direction:ltr">
                                                        {{CURRENCY}}  {{$order->subtotal_price}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <div class="m_-4831759070221370014fare-note m_-4831759070221370014fare-note-bottom"
                                             style="margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#8899a6;font-size:12px;display:flex;margin:5px 0 0 0">
                                           {{$order->payment_type}}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="m_-4831759070221370014block"
                       style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;background:white;border-radius:4px;padding:32px 0;border-collapse:separate;width:100%;display:table;margin:15px 0 0 0">
                    <tbody>
                    <tr class="m_-4831759070221370014captain-row"
                        style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <table class="m_-4831759070221370014block-inner m_-4831759070221370014captain-profile"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;display:block;border-collapse:separate;width:100%;display:table;padding:0 32px">
                                <tbody>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">


                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:inline">
                                        <table class="m_-4831759070221370014profile"
                                               style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;width:100%">
                                            <tbody>
                                            <tr>
                                                <td class="m_-4831759070221370014captain-photo"
                                                    style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;width:12%;padding-left:12px">
                                                    <img src="https://ci4.googleusercontent.com/proxy/Yb06t-fHjOK9L9oQNWF_xmsbOy4gtgH-1Kg5_6kmQSOOCCz0jJIN-mlfIq1BgQYx3mQf8oe-yBELYI22hNwJfYmls32TBJLtyFWoZcAObHTo0EbryHPz_t1i_OM=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/captain_avatar.png"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:56px;height:56px"
                                                         class="CToWUd">
                                                </td>

                                                <td class="m_-4831759070221370014captain-details"
                                                    style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;width:88%">
                                                    <table style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0">
                                                        <tbody>
                                                        <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                            <td class="m_-4831759070221370014name"
                                                                style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;font-weight:bold">
                                                                {{$order->delegate->name}}
                                                            </td>
                                                        </tr>
                                                        <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                            <td class="m_-4831759070221370014car-detail"
                                                                style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#606c74">
                                                                {{--Go--}}
                                                                {{--White Skoda--}}
                                                            </td>
                                                        </tr>
                                                        <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                            <td class="m_-4831759070221370014car-detail"
                                                                style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#606c74">
                                                                {{--Fabia--}}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>


                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>


                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:inline">
                                        <table class="m_-4831759070221370014lost-an-item"
                                               style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;margin-top:37px;margin-right:66px">
                                            <tbody>
                                            <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                                    <a href="https://help.careem.com/hc/en-us/articles/360001144688-I-lost-an-item"
                                                       style="margin:0;padding:0;border:0;font-size:100%;font:inherit;text-decoration:none"
                                                       target="_blank"
                                                       data-saferedirecturl="https://www.google.com/url?q=https://help.careem.com/hc/en-us/articles/360001144688-I-lost-an-item&amp;source=gmail&amp;ust=1549442808818000&amp;usg=AFQjCNGktLt9Mv1zwU9od250MHMgsCrlPw">
                                                        {{--<div class="m_-4831759070221370014button"--}}
                                                             {{--style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border:1px solid #37b44e;border-radius:4px;color:#37b44e;background:white;padding:12px 16px;white-space:nowrap;width:70%">--}}
                                                            {{--فقدت شيئا؟--}}
                                                        {{--</div>--}}
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="m_-4831759070221370014block"
                       style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;background:white;border-radius:4px;padding:32px 0;border-collapse:separate;width:100%;display:table;margin:15px 0 0 0">
                    <tbody>
                    <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                        <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                            <table class="m_-4831759070221370014block-inner"
                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit;border-collapse:collapse;border-spacing:0;border-collapse:separate;width:100%;display:table;padding:0 32px">
                                <tbody>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <p class="m_-4831759070221370014bold m_-4831759070221370014align-center m_-4831759070221370014thank-you"
                                           style="margin:0;padding:0;border:0;font-size:100%;font:inherit;font-weight:bold;text-align:center;font-size:14px;margin-bottom:3px">
                                            شكرا لاستخدامك بيم
                                        </p>
                                    </td>
                                </tr>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <p class="m_-4831759070221370014light-grey m_-4831759070221370014align-center"
                                           style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#8899a6;text-align:center">
                                            رقم الطلب
                                       {{$order->code}}
                                        </p>
                                    </td>
                                </tr>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <div class="m_-4831759070221370014stripes"
                                             style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin-top:33px;margin-bottom:25px">
                                            <img src="https://ci3.googleusercontent.com/proxy/hVkutFhZEZscZxvcDDIppRtlbsKY69tiimPz1uvXTScpvemVUmUam4IhFgPwEjJJ4q4I-RK3VfXQgSHWirJcS-suynoh0eR5ftzv8hv35LaWL6t61A=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/Stripes.png"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:block;margin-left:auto;margin-right:auto;width:240px"
                                                 class="CToWUd">
                                        </div>
                                    </td>
                                </tr>


                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <div class="m_-4831759070221370014social"
                                             style="margin:0;padding:0;border:0;font-size:100%;font:inherit;display:flex;width:max-content;margin:auto;margin-bottom:4px">
                                            <div class="m_-4831759070221370014circle-logo"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin-left:3px;margin-right:3px">
                                                <a href="http://www.fb.com/careem"
                                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit"
                                                   target="_blank"
                                                   data-saferedirecturl="https://www.google.com/url?q=http://www.fb.com/careem&amp;source=gmail&amp;ust=1549442808818000&amp;usg=AFQjCNGv6QNJVR8X7vQ1WflFQQGVKf_jPw">
                                                    <img src="https://ci4.googleusercontent.com/proxy/IUn-uW3enJKbEW5CU4STwp0wS_Pw4hBRvaumNXzf0DAWPOxberLVy5Vmp0b_Ect9cjowS6bciU8lTbFhARF9kCGBzscEQtuqAR3iJZNdpHX-MW_7YSe2HqCxlsLV=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/icons/Social_Fb.png"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:24px;height:24px"
                                                         class="CToWUd">
                                                </a>
                                            </div>
                                            <div class="m_-4831759070221370014circle-logo"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin-left:3px;margin-right:3px">
                                                <a href="https://twitter.com/careem"
                                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit"
                                                   target="_blank"
                                                   data-saferedirecturl="https://www.google.com/url?q=https://twitter.com/careem&amp;source=gmail&amp;ust=1549442808818000&amp;usg=AFQjCNEdRC96Me4ZslGboWXuiIPWh10HqA">
                                                    <img src="https://ci3.googleusercontent.com/proxy/c17zWDS7qdZjLbLc6JedkGdyiCuXTQ5oJ3zw9RPKzs9NOTSK3YYmqrDwm-MFGvcd4dYMX7mS9Ieywnb94ub_MHNHrZbRsTTyqvRNsUVH47VJ477U8j5JnzCwwQlzWd3ca7c=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/icons/Social_twitter.png"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:24px;height:24px"
                                                         class="CToWUd">
                                                </a>
                                            </div>
                                            <div class="m_-4831759070221370014circle-logo"
                                                 style="margin:0;padding:0;border:0;font-size:100%;font:inherit;margin-left:3px;margin-right:3px">
                                                <a href="https://www.instagram.com/careem/"
                                                   style="margin:0;padding:0;border:0;font-size:100%;font:inherit"
                                                   target="_blank"
                                                   data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/careem/&amp;source=gmail&amp;ust=1549442808818000&amp;usg=AFQjCNG0h9k0XrmArYTLzCuJcc0kHOsGAg">
                                                    <img src="https://ci6.googleusercontent.com/proxy/v52KjYwxz7r0LZ98K4y91rZZwV6beEzxcmY5WWLEWSrs5uPla_3S4wcA_21wPpXY2MalmDWv3dib0fmZ0Y35ocrSv9GlbSXnFYYavmKTUyTseJEck-UznXJhUwRxHUt-=s0-d-e1-ft#https://s3-eu-west-1.amazonaws.com/trip-reciept/assets/icons/Social_Insta.png"
                                                         style="margin:0;padding:0;border:0;font-size:100%;font:inherit;width:24px;height:24px"
                                                         class="CToWUd">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                    <td style="margin:0;padding:0;border:0;font-size:100%;font:inherit">
                                        <p class="m_-4831759070221370014light-grey m_-4831759070221370014align-center"
                                           style="direction:rtl;margin:0;padding:0;border:0;font-size:100%;font:inherit;color:#8899a6;text-align:center">
                                            حقوق النشر بيم 2019 ⓒ
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="yj6qo"></div>
                <div class="adL">
                </div>
            </div>
            <div class="adL">

            </div>
        </div>
    </div>
    <div id=":nz" class="ii gt" style="display:none">
        <div id=":o0" class="a3s aXjCH undefined"></div>
    </div>
    <div class="hi"></div>
</div>
</body>
</html>
