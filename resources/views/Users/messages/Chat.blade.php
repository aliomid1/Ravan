@extends('layout.Chat.template')
@section('content')
    <div class="container-fluid">
        <div class="col-12 text-center mb-5">
            <h4>گفتگو انلاین</h4>
            <h5>اقای حسینی</h5>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>تماس تصویری</h5>
                            <button class="btn btn-video-call btn-success">
                                <i class="fa fa-video-camera"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="you">
                            <video src=""></video>
                        </div>
                        <div class="side">
                            <video src=""></video>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>پیام ها</h5>
                            <button class="btn btn-video-call btn-success">
                                <i class="fa fa-phone"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form name="frmChat" class="chatss" id="frmChat">
                            <div id="chat-box"></div>
                        </form>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>ارسال ویس</h5>
                            <button class="btn btn-video-call btn-info">
                                <i class="fa fa-microphone"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ارسال پیام</h5>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="hidden" id="chat-user" value="ALi">
                        <input type="text" name="chat-message" id="chat-message" class="form-control" placeholder="Message"
                            class="chat-input chat-message" required />
                        <div class="input-group-prepend">
                            <button type="button" id="btnSend" name="send-chat-message"
                                class="btn btn-success">ارسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        body {
            padding: 0 !important;
        }

        .you video {
            position: absolute;
            bottom: 29px;
            right: 20px;
            height: 200px;
            width: 200px;
            background: #444;
            border-radius: 5px;
        }

        .side video {
            width: 100%;
            height: 400px;
            background: #555;
            border-radius: 8px;
        }

        .main-content {
            margin: 0 !important;
        }

        .btn-video-call {
            font-size: 18px;
            text-align: center;
            border-radius: 10px;
            line-height: 20px;
        }

        .chatss {
            height: 389px;
            overflow-y: scroll;
        }

        /* width */
        .chatss::-webkit-scrollbar {
            width: 4px;
            border-radius: 10px;
        }

        /* Track */
        .chatss::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        /* Handle */
        .chatss::-webkit-scrollbar-thumb {
            background: rgb(189, 189, 189);
            border-radius: 10px;
        }

        /* Handle on hover */
        .chatss::-webkit-scrollbar-thumb:hover {
            background: rgb(126, 126, 126);
            border-radius: 10px;
        }

    </style>
@endsection
