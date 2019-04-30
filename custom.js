//function userGenerateNickName() {
    $(document).on("click", ".member", function () {
        var action = 'selectmember';
        var time = '';
        var member = $(this).attr("rel");
        var item = $('.active' + member).parent();
        $('.member').removeClass('current');
        item.addClass("current");
        $.ajax({
            url: baseUrl + "checkinmember/process",
            data: {action: action, member: member},
            type: 'POST',
            beforeSend: function () {
            },
            success: function (result) {
                if (result == '1') {
                    time = '30 Mins';
                } else if (result == '2') {
                    time = '1 Hour';
                } else if (result == '3') {
                    time = '1 Hour 30 Mins';
                } else if (result == '4') {
                    time = '2 Hours';
                } else if (result == '5') {
                    time = '2 Hours 30 Mins';
                } else if (result == '6') {
                    time = '3 Hours';
                }
                document.getElementById('totalmember').value = result;
                $("#showmemberselect").html('<p>' + result + ' Member(s) have been selected, please click Continue</p>');
                $("#showqty").html(result);
                $("#showtim").html(time);
                $('.time').removeClass('current');
                $("#tm" + result).addClass("current");
            },
            error: function () {
            }
        });
    });
//}
//function timeSelect() {
    $(document).on("click", ".time", function () {
        var action = 'selecttime';
        var memberid = $(this).attr("rel");
        var time = $(this).attr("time");
        var item = $('.activess' + memberid).parent();
        $('.time').removeClass('current');
        item.addClass("current");
        $.ajax({
            url: baseUrl + "checkinmember/process",
            data: {action: action, memberid: memberid},
            type: 'POST',
            beforeSend: function () {
            },
            success: function (result) {
                document.getElementById('expId').value = result;
                document.getElementById('expTime').value = time;
                $("#showtimeselect").html(time + ' has been selected, please click Continue');
                $("#showtimeselect2").html(time + ' has been selected, please click Continue');
                if (memberid == 8) {
                    $("#shoot").removeClass("showshooting");
                    $("#shoot").addClass("showshootingpop");
                } else {
                    $("#shoot").removeClass("showshootingpop");
                    $("#shoot").addClass("showshooting");
                }
            },
            error: function () {
            }
        });
    });
//}
function secondstep() {
    //$(document).on("click", "#secstep", function () {
        var totalmember = $('#totalmember').val();
        var addmembertotal = $('#addmembertotal').val();
        if (totalmember == '') {
            $("#showmemberselect").html('<p style="color:#F00;">Please select a member</p>');
        } else if(parseInt(totalmember)<(parseInt(addmembertotal)-1)) {
            $("#showmemberselect").html('<p style="color:#F00;">Please delete member from selected members</p>');
        } else {
            getPlayers();
            /*everyinterval = setInterval(function(){
                getPlayers();
            }, 1000*30);*/
            $("#showallsearchby").html('');
            document.getElementById('exist').value = 0;
            $("#secondstep").removeClass("hide");
            $("#secondstep").addClass("show");
            $("#firststep").removeClass("show");
            $("#firststep").addClass("hide");

        }
    //});
}
function secondstepadparty() {
    //$(document).on("click", "#secstep", function () {
        var totalmember = $('#totalmember').val();
        var partysize = $('#partysize').val();
        var checkpartysize = parseInt(totalmember) + parseInt(partysize);
        if (totalmember == '') {
            $("#showmemberselect").html('<p style="color:#F00;">Please select a member</p>');
        } else if (checkpartysize > 6) {
            $("#showmemberselect").html('<p style="color:#F00;">A maximum of 6 members are allowed in a party.</p>');
        } else {
            $("#showallsearchby").html('');
            document.getElementById('exist').value = 0;
            $("#secondstep").removeClass("hide");
            $("#secondstep").addClass("show");
            $("#firststep").removeClass("show");
            $("#firststep").addClass("hide");
            getPlayers();
        }
    //});
}
function addExistingMethod() {
    //$(document).on("click", "#secsteptwo", function () {
        var totalmember = $('#totalmember').val();
        if (totalmember == '') {
            $("#showmemberselect").html('<p style="color:#F00;">Please select a member</p>');
        } else {
            document.getElementById('exist').value = 1;
            $("#secondstep").removeClass("hide");
            $("#secondstep").addClass("show");
            $("#firststep").removeClass("show");
            $("#firststep").addClass("hide");
            $('#nextbtnad2').removeClass('showtime');
            $('#nextbtnad2').addClass('timeskip');
            getPlayers();
        }
    //});
}
function getMemberInfo() {
    show_load();
    var qrcode = $('#qrcode').val();
    $.ajax({
        url: checkinUrl,
        headers: {apicode: apiCode, token: user_token},
        data: {
            membership_number: qrcode, mac_address: macAddress
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            $("#notqr").html('');
            check_in_baymember(result.gamertag, result.firstname + ' ' + result.lastname, result.gamertag, result.isjunior, result.isauthorized, result.primary_gamertag);
        },
        error: function () {
            $("#alreadyadded").html('');
            $("#againsrch").html('');
            $("#notqr").html('Membership number does not exist.');
            hide_load();
        }
    });
}
function check_in_baymember(membergamertag, name, gamer, isjunior, authoriz, primarygamer) {
    show_load();
    var membergamertag = membergamertag;
    var name = name;
    var gamer = gamer;
    var isjunior = isjunior;
    var authoriz = authoriz;
    var primarygamer = primarygamer;
    $.ajax({
        url: api_url + api_version + 'AuthorizeCheckIn',
        headers: {apicode: apiCode, token: user_token},
        data: {gamertag: membergamertag
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.status == true) {
                $("#baymsgmember").html('The member ' + result.memberinfo.firstname + '&nbsp;' + result.memberinfo.lastname + ' already assigned at ' + result.memberinfo.activity_type);
                $("#checkinmemberbaypop").click();
                hide_load();
            } else {
                checkjunior_isfirst(name, gamer, isjunior, authoriz, primarygamer);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function checkjunior_isfirst(name, gamertag, junior, authoriz, primary_member) {
    var action = 'checkjuniorisfirst';
    var searchingids = $('#memberids').val();
    var allmembersIds = searchingids.substring(1);
    var name = name;
    var gamertag = gamertag;
    var isjuniors = junior;
    var isauthoriz = authoriz;
    var primarymember = primary_member;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, allmembersIds: allmembersIds, isjuniors: isjuniors},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'firstjunior') {
                $("#juniorfirstpop").click();
                hide_load();
            } else {
                //checkMember(name,gamertag);
                checkjunior_isauthorizedfirst(name, gamertag, junior, isauthoriz, primarymember);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function checkjunior_isauthorizedfirst(name, gamertag, junior, isauthoriz, primarymember) {
    var action = 'checkjuniorauthoriz';
    var searchingids = document.getElementById('memberids').value;
    var isauthoriz = isauthoriz;
    var primarymember_gamertag = primarymember;
    var allmembersIds = searchingids.substring(1);
    var name = name;
    var gamertag = gamertag;
    var isjuniors = junior;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, allmembersIds: allmembersIds, isjuniors: isjuniors, isauthoriz: isauthoriz, primarymember_gamertag: primarymember_gamertag},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'primarymembernotadded') {
                $("#primarymemberpop").click();
                hide_load();
            } else {
                checkMember(name, gamertag);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function checkMember(membername, memberid) {
    show_load();
    var action = 'checkmember';
    var searchingresults = $('#searchingresults').val();
    var searchArray = searchingresults.substring(1);
    var searchingids = $('#memberids').val();
    var allmembersIds = searchingids.substring(1);
    var totalmember = $('#totalmember').val();
    var addmembertotal = $('#addmembertotal').val();
    var showtotdmember = parseInt(addmembertotal) + parseInt("1");
    var showtotdmemberminus = parseInt(addmembertotal) - parseInt("1");
    var member_name = membername;
    var member_id = memberid;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchArray: searchArray, member_name: member_name, member_id: member_id, allmembersIds: allmembersIds},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'Match not found') {
                if (addmembertotal > totalmember && addmembertotal == '7') {
                    hide_load();
                    $("#againsrch").html('');
                    $("#alreadyadded").html('');
                    $("#notqr").html('');
                    $("#showsrcherror").html('');
                    $("#outofname").html(member_name);
                    $("#outofchecking").html('Maximum of 6 members allowed per shooting lounge');
                    $("#nextbtn2").css("display", "none");
                    $("#clickaddmoreplayes").click();
                } else if (addmembertotal == totalmember) {
                    if (addmembertotal == '6') {
                        hide_load();
                        $("#alreadyadded").html('');
                        $("#againsrch").html('');
                        $("#showsrcherror").html('');
                        document.getElementById('addmembertotal').value = showtotdmember;
                        searchQrOne(member_name, memberid);
                        $("#outofname").html(member_name + ' Added');
                        $("#outofchecking").html(addmembertotal + ' out of ' + totalmember + ' Members have been received.');
                        $("#nextbtn2").css("display", "none");
                        $("#clickaddmoreplayes").click();
                    } else {
                        hide_load();
                        $("#alreadyadded").html('');
                        $("#againsrch").html('');
                        $("#showsrcherror").html('');
                        document.getElementById('addmembertotal').value = showtotdmember;
                        searchQrOne(member_name, memberid);
                        $("#outofname").html(member_name + ' Added');
                        $("#outofchecking").html(addmembertotal + ' out of ' + totalmember + ' Members have been received. Would you like to Scan/Search for more members?');
                        //$("#clickaddmoreplayes").click();
                        $(".showtime").removeClass('hide');
                    }
                } else if (addmembertotal > totalmember && addmembertotal != '7') {
                    hide_load();
                    $("#alreadyadded").html('');
                    $("#againsrch").html('');
                    $("#showsrcherror").html('');
                    $("#outofname").html(member_name);
                    $("#outofchecking").html(showtotdmemberminus + ' out of ' + totalmember + ' Members have been received. Would you like to add more players?');
                    //$("#clickaddmoreplayes").click();
                    $(".showtime").removeClass('hide');

                } else {
                    $("#alreadyadded").html('');
                    $("#againsrch").html('');
                    $("#showsrcherror").html('');
                    document.getElementById('addmembertotal').value = showtotdmember;
                    searchQr(member_name, memberid);
                }
            } else {
                hide_load();
                $("#againsrch").html('');
                $("#showsrcherror").html('');
                $("#alreadyadded").html('<span class="eror">Please select different Member ID.</span>');
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function checkMember_second(membername, memberid) {
    show_load();
    var action = 'checkmember';
    var searchingresults = $('#searchingresults').val();
    var searchArray = searchingresults.substring(1);
    var searchingids = $('#memberids').val();
    var allmembersIds = searchingids.substring(1);
    var totalmember = $('#totalmember').val();
    var addmembertotal = $('#addmembertotal').val();
    var showtotdmember = parseInt(addmembertotal) + parseInt("1");
    var showtotdmemberminus = parseInt(addmembertotal) - parseInt("1");
    var member_name = membername;
    var member_id = memberid;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchArray: searchArray, member_name: member_name, member_id: member_id, allmembersIds: allmembersIds},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'Match not found') { // showTimeSelection();
                if (addmembertotal > totalmember && addmembertotal == '7') {
                    hide_load();
                    $("#againsrch").html('');
                    $("#alreadyadded").html('');
                    $("#notqr").html('');
                    $("#showsrcherror").html('');
                    $("#outofname").html(member_name);
                    $("#outofchecking").html('Maximum of 6 members allowed per shooting lounge');
                    $("#nextbtn2").css("display", "none");
                    $("#clickaddmoreplayes").click();
                } else if (addmembertotal == totalmember) {
                    if (addmembertotal == '6') {
                        hide_load();
                        $("#againsrch").html('');
                        $("#alreadyadded").html('');
                        $("#notqr").html('');
                        $("#showsrcherror").html('');
                        document.getElementById('addmembertotal').value = showtotdmember;
                        searchQrOne(member_name, memberid);
                        $("#outofname").html(member_name + ' Added');
                        $("#outofchecking").html(addmembertotal + ' out of ' + totalmember + ' Members have been received.');
                        $("#nextbtn2").css("display", "none");
                        //$("#clickaddmoreplayes").click();
                    } else {
                        hide_load();
                        $("#againsrch").html('');
                        $("#alreadyadded").html('');
                        $("#notqr").html('');
                        $("#showsrcherror").html('');
                        document.getElementById('addmembertotal').value = showtotdmember;
                        searchQrOne(member_name, memberid);
                        $("#outofname").html(member_name + ' Added');
                        $("#outofchecking").html(addmembertotal + ' out of ' + totalmember + ' Members have been received. Would you like to Scan/Search for more members?');
                        //$("#clickaddmoreplayes").click();
                        $(".showtime").removeClass('hide');
                    }
                } else if (addmembertotal > totalmember && addmembertotal != '7') {
                    hide_load();
                    $("#againsrch").html('');
                    $("#alreadyadded").html('');
                    $("#notqr").html('');
                    $("#showsrcherror").html('');
                    $("#outofname").html(member_name);
                    $("#outofchecking").html(showtotdmemberminus + ' out of ' + totalmember + ' Members have been received. Would you like to add more players?');
                    //$("#clickaddmoreplayes").click();
                    //$(".showtime").removeClass('hide');
                } else {
                    $("#againsrch").html('');
                    $("#alreadyadded").html('');
                    $("#notqr").html('');
                    $("#showsrcherror").html('');
                    document.getElementById('addmembertotal').value = showtotdmember;
                    searchQr(member_name, memberid);
                }
            } else {
                hide_load();
                $("#alreadyadded").html('');
                $("#notqr").html('');
                $("#showsrcherror").html('');
                $("#againsrch").html('<p style="color:#F00;">This member has already been added.</p>');
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function searchQrOne(qrcodename, memid) {
    show_load();
    var action = 'searchqrcode';
    var searchingresults = $('#searchingresults').val();
    var totalmemberselect = $('#totalmember').val();
    var addmembertotal = $('#addmembertotal').val();
    var memberid = $('#memberids').val();
    var qrcode = qrcodename;
    var showtotaladdedmember = parseInt(addmembertotal) - parseInt("1");
    var formid = document.getElementById('searchqrcode');
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchingresults: searchingresults, qrcode: qrcode},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            var allmembers = searchingresults + ',' + result;
            document.getElementById('searchingresults').value = allmembers;
            document.getElementById('memberids').value = memberid + ',' + memid;
            $("#memname").html(qrcode + ' Added');
            $("#totalmemberadd").html(showtotaladdedmember + '/' + totalmemberselect + ' players checked-In, Scan or Search for More Players?');
            showSearchQrresultOne(result);
            formid.reset();
        },
        error: function () {
        }
    });
}
function showSearchQrresultOne(newmember) {
    show_load();
    var waiting_id = $("#waitinglistid").val();
    var partymembername = $("#memName").val();
	var exist = $('#exist').val();
    var action = 'showsearchresult';
    var searchingresults = $('#searchingresults').val();
    var searchArray = searchingresults.substring(1);
    var memberids = $('#memberids').val();
    var memberidsArray = memberids.substring(1);
    var newmembers = newmember;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchArray: searchArray, memberidsArray: memberidsArray},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            hide_load();
            $("#showallmembers").html(result);
            $("#showallmemberstwo").html(result);
            var pathname = window.location.pathname; // Returns path only
            var bayid = $("#bayids").val();
            if (pathname.toLowerCase().indexOf("assigntiming") >= 0) {
                existingReservations(bayid);
                //window.location.href = baseUrl;
            } else if (pathname.toLowerCase().indexOf("waitinglist") >= 0 && waiting_id != "") {
                addpartyMember(waiting_id, partymembername);
                //window.location.href = baseUrl;
            } else {
				if(exist == 1){
					$(".showshooting").click();	
				}else{
                	$(".showtime").click();
				}
				
            }
        },
        error: function () {
        }
    });
}
function searchQr(qrcodename, memid) {
    show_load();
    var action = 'searchqrcode';
    var searchingresults = $('#searchingresults').val();
    var totalmemberselect = $('#totalmember').val();
    var addmembertotal = $('#addmembertotal').val();
    var qrcode = qrcodename;
    var memberid = $('#memberids').val();
    var showtotaladdedmember = parseInt(addmembertotal) - parseInt("1");
    var formid = document.getElementById('searchqrcode');
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchingresults: searchingresults, qrcode: qrcode},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            var allmembers = searchingresults + ',' + result;
            document.getElementById('searchingresults').value = allmembers;
            document.getElementById('memberids').value = memberid + ',' + memid;
            $("#memname").html(qrcode + ' Added');
            $("#totalmemberadd").html(showtotaladdedmember + '/' + totalmemberselect + '  Members have been received. Would you like to Scan/Search for more members?');
            showSearchQrresult(result);
            //$(".showtime").removeClass("hide");
            formid.reset();
        },
        error: function () {
        }
    });
}
function showSearchQrresult(newmember) {
    show_load();
    var action = 'showsearchresult';
    var searchingresults = $('#searchingresults').val();
    var exist = $('#exist').val();
    var searchArray = searchingresults.substring(1);
    var memberids = $('#memberids').val();
    var memberidsArray = memberids.substring(1);
    var newmembers = newmember;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchArray: searchArray, memberidsArray: memberidsArray},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            hide_load();
            $("#showallmembers").html(result);
            $("#showallmemberstwo").html(result);
            if (exist == 1) {
                $("#timeseldt").removeClass("timeselect");
                $("#timeseldt").addClass("timeskip");
                $("#clickqrcodes").click();
				//$(".showshooting").click();
            } else {
                $("#timeseldt").removeClass("timeskip");
                $("#timeseldt").addClass("timeselect");
                //$("#clickqrcodes").click();
                $(".showtime").removeClass("hide");
            }
        },
        error: function () {
        }
    });
}

function userSearchBy() {
    show_load();
    var action = $('#searchmembers #action').val();
    var srchby = $('#searchmembers #srchby').val();
    var searchby = $('#searchmembers #searchby:checked').val();

    $.ajax({
        url: api_url + api_version + "PlayerSearch?filter=" + searchby + "&value=" + srchby,
        headers: {apicode: apiCode, token: user_token},
        data: {
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.members.length > 0) {
                var showSrch = '';
                showSrch += '<div class="overflow"><table id="example" class="display">';
                showSrch += '<thead>';
                showSrch += '<tr>';
                showSrch += '<th>First Name</th>';
                showSrch += '<th>Last Name</th>';
                showSrch += '<th>Email</th>';
                showSrch += '<th>Nickname</th>';
                showSrch += '<th>Phone</th>';
                showSrch += '<th style="display:none;">Phone Set</th>';
                showSrch += '<th>DOB</th>';
                showSrch += '</tr>';
                showSrch += '</thead>';
                showSrch += '<tbody>';
                for (var i = 0; i < result.members.length; i++) {
                    showSrch += '<tr id=memlist' + i + ' class="addmembs" primary_gamertag=' + result.members[i].primary_gamertag + ' authoriz=' + result.members[i].isauthorized + ' junior=' + result.members[i].isjunior + ' gamertag="' + result.members[i].gamertag + '" name=' + result.members[i].firstname + '&nbsp;' + result.members[i].lastname + ' onclick="single_click_function(' + i + ');" ondblclick="double_click_function(' + i + ');">';
                    showSrch += '<td>' + result.members[i].firstname + '</td>';
                    showSrch += '<td>' + result.members[i].lastname + '</td>';
                    showSrch += '<td>' + result.members[i].email + '</td>';
                    showSrch += '<td>' + result.members[i].gamertag + '</td>';
                    showSrch += '<td>' + result.members[i].phone + '</td>';
                    showSrch += '<td style="display:none;">' + ((result.members[i].phone.replace(/\(|\)/g, "")).replace('-', '')).replace(' ', '') + '</td>';
                    showSrch += '<td>' + result.members[i].dob + '</td>';
                    showSrch += '</tr>';
                }
                showSrch += '</tbody>';
                showSrch += '</table></div>';
                showSrch += '<div class="footer-button"><input type="hidden" name="primarymember_gamertag" id="primarymember_gamertag" value=""><input type="hidden" name="isauthorizeds" id="isauthorizeds" value=""><input type="hidden" name="isjunior" id="isjunior" value=""><a id="nextbtn" class="btn btn-default active1 addsearchingmembers">Add Selected Member</a></div>';
                $("#showsrcherror").html('');
                $("#showallsearchby").html(showSrch);
                $('#example').DataTable();
            } else {
                $("#showallsearchby").html('');
                $("#showsrcherror").html('<p>Unable to find any members with this criteria</p>');
            }
            hide_load();
        },
        error: function () {
            $("#showallsearchby").html('');
            $("#showsrcherror").html('<p>Unable to find any members with this criteria</p>');
            hide_load();
        }
    });
}

function single_click_function(id) {
    $(document).on("click", "#memlist" + id, function () {
        var name = $(this).attr("name");
        var junior = $(this).attr("junior");
        var gamertag = $(this).attr("gamertag");
        var isauthriz = $(this).attr("authoriz");
        var primary_gamertag = $(this).attr("primary_gamertag");
        $('.display td').removeClass('green_row');
        $('#memlist' + id + ' td').addClass('green_row');
        /*$('div.dataTables_filter input[type=search]').val('');*/
        document.getElementById('selectmemid').value = gamertag;
        document.getElementById('selectmemname').value = name;
        document.getElementById('isjunior').value = junior;
        document.getElementById('isauthorizeds').value = isauthriz;
        document.getElementById('primarymember_gamertag').value = primary_gamertag;
    });
}
function double_click_function(id) {
    var name = $("#memlist" + id).attr("name");
    var junior = $("#memlist" + id).attr("junior");
    var gamertag = $("#memlist" + id).attr("gamertag");
    var isauthriz = $("#memlist" + id).attr("authoriz");
    var primary_gamertag = $("#memlist" + id).attr("primary_gamertag");
	var istraningcompleted = $("#memlist" + id).attr("istraningcompleted");
	//alert(istraningcompleted);
    $('.scroll td').removeClass('green_row');
    $('#memlist' + id + ' td').addClass('green_row');
    $('div.dataTables_filter input[type=search]').val('');
    document.getElementById('selectmemid').value = gamertag;
    document.getElementById('selectmemname').value = name;
    document.getElementById('isjunior').value = junior;
    document.getElementById('isauthorizeds').value = isauthriz;
    document.getElementById('primarymember_gamertag').value = primary_gamertag;

    check_in_baymember2(gamertag, name, gamertag, junior,istraningcompleted);
}
function showTimeSelection() {
    show_load();
    var totalmember = $('#totalmember').val();
    $.ajax({
        url: api_url + api_version + "TimeSelect?siteid=1&playercount=" + totalmember,
        headers: {apicode: apiCode, token: user_token},
        data: {
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            var time_div = '';
            var unlimited = '';
			var time_message = '';
            time_div += '<div class="bs-example">';
            for (var i = 0; i < result.experiences.length; i++) {
                if (result.experiences[i].expname == '30 Mins' && totalmember == 1) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '30 Mins has been selected, please click Continue';
                }else if (result.experiences[i].expname == '1 Hour' && totalmember == 2) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '1 Hour has been selected, please click Continue';
                }else if (result.experiences[i].expname == '1 Hour 30 Mins' && totalmember == 3) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '1 Hour 30 Mins has been selected, please click Continue';
                } else if (result.experiences[i].expname == '2 Hours' && totalmember == 4) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '2 Hours has been selected, please click Continue';
                } else if (result.experiences[i].expname == '2 Hours 30 Mins' && totalmember == 5) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '2 Hours 30 Mins has been selected, please click Continue';
                } else if (result.experiences[i].expname == '3 Hours' && totalmember == 6) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
					time_message += '3 Hours Mins has been selected, please click Continue';
                }  else if (result.experiences[i].expname == 'Unlimited') {
                    unlimited += '<a id="tm' + result.experiences[i].id + '" class="time unlimit" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                } else {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default timeselectbtn activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                }
            }
            time_div += unlimited;
            time_div += '</div>';
            $("#timetoshow").html(time_div);
			$("#showtimeselect").html(time_message);
            hide_load();
        },
        error: function () {
            hide_load();
        }
    });
}
function checkjunior_isfirst2(name, gamertag, junior,istraningcompleted) {
    var action = 'checkjuniorisfirst';
    var searchingids = document.getElementById('memberids').value;
    var allmembersIds = searchingids.substring(1);
    var name = name;
    var gamertag = gamertag;
    var isjuniors = junior;
    var first_jn = document.getElementById('first_junior').value;
	
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, allmembersIds: allmembersIds, isjuniors: isjuniors},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'firstjunior') {
                if (first_jn == 'ok') {
                    checkjunior_isauthorized(name, gamertag, junior,istraningcompleted);
                } else {
                    $("#juniorfirstpop").click();
                    hide_load();
                }
            } else {
                checkjunior_isauthorized(name, gamertag, junior,istraningcompleted);
                //checkMember_second(name,gamertag);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function checkjunior_isauthorized(name, gamertag, junior,istraningcompleted) {

    var pathname = window.location.pathname; // Returns path only
    var adultGamerTags = "";
    if (pathname.toLowerCase().indexOf("assigntiming") >= 0) {
        adultGamerTags = document.getElementById('adultGamerTags').value;
    }

    var action = 'checkjuniorauthoriz';
    var searchingids = document.getElementById('memberids').value;
    var isauthoriz = document.getElementById('isauthorizeds').value;
    var primarymember_gamertag = document.getElementById('primarymember_gamertag').value;
    var allmembersIds = searchingids.substring(1);
    var name = name;
    var gamertag = gamertag;
    var isjuniors = junior;
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, allmembersIds: allmembersIds, isjuniors: isjuniors, isauthoriz: isauthoriz, primarymember_gamertag: primarymember_gamertag, adultGamerTags: adultGamerTags},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == 'primarymembernotadded') {
                $("#primarymemberpop").click();
                hide_load();
            }else if (istraningcompleted == 'false' && isjuniors=='true') {
                $("#trainingnotcompletedpop").click();
                hide_load();
			}else {
                checkMember_second(name, gamertag);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function check_in_baymember2(gamertag, name, id, junior,istraningcompleted) {
    show_load();
    var gamertag = gamertag;
    var name = name;
    var id = id;
    var junior = junior;
var istraningcompleted = istraningcompleted;
    $.ajax({
        url: api_url + api_version + "AuthorizeCheckIn",
        headers: {apicode: apiCode, token: user_token},
        data: {gamertag: gamertag
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
			if (result.status == true) { //alert(result.status);
				//document.getElementById('paid_unpaid').value = result.paidmembership;
                $("#baymsgmember").html('The member ' + result.memberinfo.firstname + '&nbsp;' + result.memberinfo.lastname + ' already assigned at ' + result.memberinfo.activity_type);
                $("#checkinmemberbaypop").click();
                hide_load();
            }else {
				document.getElementById('paid_unpaid').value = result.paidmembership;
				//alert("checkjunior_isfirst2 815");
                checkjunior_isfirst2(name, id, junior,istraningcompleted);
                //checkjunior_isfirst(name,gamer,isjunior,authoriz,primarygamer);
            }
        },
        error: function () {
            hide_load();
        }
    });
}
function getBayHeaders() {
    $.ajax({
        url: api_url + api_version + 'BayHeader',
        headers: {apicode: apiCode, token: user_token},
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            var left = result.headers[0].name;
            var middle = result.headers[1].name;
            var right = result.headers[2].name;
            $(".leftBayGroup").val(left);
            $(".middleBayGroup").val(middle);
            $(".rightBayGroup").val(right);
        },
        error: function () {
            $(".leftBayGroup").val('Left');
            $(".middleBayGroup").val('Middle Section');
            $(".rightBayGroup").val('Right Section');
        }
    });
}
function updateBayHeaders(id, value) {
    $.ajax({
        url: api_url + api_version + 'BayHeader',
        headers: {apicode: apiCode, token: user_token},
        type: 'POST',
        data: {id: id, name: value},
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            $(".leftBayGroup").prop('disabled', true);
            $(".middleBayGroup").prop('disabled', true);
            $(".rightBayGroup").prop('disabled', true);
        },
        success: function (result) {
            getBayHeaders();
            $(".leftBayGroup").prop('disabled', false);
            $(".middleBayGroup").prop('disabled', false);
            $(".rightBayGroup").prop('disabled', false);
        },
        error: function () {
            getBayHeaders();
        }
    });
}
$(document).on("click", ".addsearchingmembers", function () {
    var junior = document.getElementById('isjunior').value;
    var id = document.getElementById('selectmemid').value;
    var name = document.getElementById('selectmemname').value;
    if (junior == '') {
        $("#againsrch").html('<p style="color:#F00;">Please Select a Member</p>');
    } else {
//checkMember_second(name,id);
        $('div.dataTables_filter input[type=search]').val('');
        $("#againsrch").html('');
        check_in_baymember2(id, name, id, junior);
//checkjunior_isfirst2(name,id,junior);
    }
});
$(document).on("click", ".adparty", function () {
    show_load();
    var action = 'checkpartymember';
    var waiting_id = $(this).attr("id");
    var partymembername = $(this).attr("name");
    var members = $('#totalmember').val();
    var partymember = $('#partymembercheck' + waiting_id).val();
    var memberids = $('#memberids').val();
    var searchArraymemberids = memberids.substring(1);
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, membersidsadd: searchArraymemberids, partymember: partymember},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            if (result == "comparenotdone") {
                $("#adpartymsg").html('<span style="color:#F00">Party Member already added</span>');
            } else {
                addpartyMember(waiting_id, partymembername);
            }
            hide_load();
        },
        error: function () {
        }
    });
});
function addpartyMember(waiting_id, partymembername) {
    var siteid = '1';
    var members = $('#totalmember').val();
    var searchingresults = $('#searchingresults').val();
    var searchArray = searchingresults.substring(1);
    var membersnameadd = searchArray.split(",");
    var memberids = $('#memberids').val();
    var searchArraymemberids = memberids.substring(1);
    var membersidsadd = searchArraymemberids.split(",");
    var adednames = '';
    $.ajax({
        url: api_url + api_version + "WaitingQueueAddParty",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: siteid, waiting_id: waiting_id, gamertag: membersidsadd},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.success == true) {
                adednames += '<ul class="adname">';
                for (var i = 0; i < membersnameadd.length; i++) {
                    adednames += '<li><b>' + membersnameadd[i] + '</b> has been added to the Wait List under party name <b>' + partymembername + '</b></li>';
                }
                adednames += '</ul>';
                $("#partymembername").html(adednames);
//$("#partymembername").html(partymembername);
                hide_load();
                $("#adpartymsg").html('');
                $("#showaddpartypopup").click();
            } else {
                hide_load();
                $("#adpartymsg").html('<span style="color:#F00">Maximum party size allowed is 6</span>');
//$("#addtopartyover").click();	
            }
        },
        error: function () {
            hide_load();
            $("#adpartymsg").html('<span style="color:#F00">Maximum party size allowed is 6</span>');
//$("#addtopartyover").click();
        }
    });
}

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return results[1] || 0;
    }
}

function updatePurchaseInformation() {
    var bayid = $('#boxIDforColorChange').val();
    $.ajax({
        url: api_url + api_version + "PurchaseInformation",
        headers: {apicode: apiCode, token: user_token},
        data: {bayid: bayid},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            var chk = $.urlParam('rcode');
            //alert(chk);
            if(chk != null)
                reservationCheckInWaitList("Check-In");
            lastFocus(bayid);

        },
        error: function () {
            hide_load();
        }
    });
}
function existingupdatePurchaseInformation() {
    var bayid = $('#boxIDforColorChange').val();
	var revcod = $('#revcode'+bayid).val();
    $.ajax({
        url: api_url + api_version + "PartyPurchaseInformation",
        headers: {apicode: apiCode, token: user_token},
        data: {bayid: bayid},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
			document.getElementById('reservationId').value = revcod;
            var chk = $.urlParam('rcode');
            //alert(chk);
            if(chk != null)
                reservationCheckInWaitList("Check-In");
                $("#assignBtn").css("display", "none");
                $("#deactivatBtn").css("display", "none");	
            lastFocus(bayid);

        },
        error: function () {
            hide_load();
        }
    });
}
function lastFocus(id) {
    var reservationId = $('#reservationId').val();
    var bayid = id;
    $.ajax({
        type: "POST",

		 url: api_url + api_version + "Micros",
        data: JSON.stringify({ ReservationId: reservationId}),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.message == 'Success') {
                //window.location.href = baseUrl;
                $(".modal-header").css("display", "block");
                $("#heading_modal_open").css("display", "block");
                $("#heading_modal_open").html("Check-In Completed");
                $("#heading_member_line").css("display", "none");
                $("#finishBtnStatusopen").css("display", "inline-block");
                $(".modal-footer").css("text-align", "center");
                $("#thirdscreen").css("display", "none");
                
                if($(".memNameagain1").html() == " " || $(".memNameagain1").html() == "") {

                    var memberName = $("#purchasemember_name").val();
                    $(".memNameagain1").html(memberName);
                    $(".memNameagain2").html(memberName);
                }

                $("#fourthscreen").css("display", "block");
                $("#backBtn").css("display", "none");
                $("#lastContinueBtnold").css("display", "none");
                $("#closeBtnStatusopen").css("display", "none");
                $("#deactivatBtn").css("display", "none");
                $("#assignBtn").css("display", "none");
                $("#firstscreen").css("display", "none");

                clearInterval(everyinterval);
                everyinterval = 0;
                $('#openStatusModal').modal();                     // initialized with defaults
                $('#openStatusModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#openStatusModal').modal('show');                // initializes and invokes show immediately
            } else {
                document.getElementById('txt_focusbayid').value = bayid;
                document.getElementById('txt_focusreservation').value = reservationId;
                $("#focusmsg").html('Could not communicate with POS Machine.<br /> Please contact system administrator - Log Ref ' + data.corelationID);
                $("#focutpop").click();
                hide_load();
            }
            hide_load();
        },
        failure: function (errMsg) {
            $("#focusmsg").html('Could not communicate with POS Machine.<br /> Please contact system administrator - Log Ref ' + data.corelationID);
            $("#focutpop").click();
            hide_load();
        }
    });
}
function blinker() {
    $('.blink_me').fadeOut(400);
    $('.blink_me').fadeIn(400);
}
setInterval(blinker, 1000);
function existingReservations(id) {
    var searchingresults = $('#memberids').val();
	var paid_unpaid = $('#paid_unpaid').val();
    var searchArray = searchingresults.substring(1);
    var members = searchArray.split(",");
	var searchingresultsname = $('#searchingresults').val();
    var searchArrayname = searchingresultsname.substring(1);
    var membersname = searchArrayname.split(",");
	var adednames = '';
    $.ajax({
        url: api_url + api_version + "ExistingReservation",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: '1', bayid: id, gamertag: members},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.issuccessful == true) {
				
				
				if(paid_unpaid == 'true'){
				adednames += '<ul class="adname">';
                for (var i = 0; i < membersname.length; i++) {
                    adednames += '<li><b>' + membersname[i] + '</b> has been added .</li>';
                }
                adednames += '</ul>';	
                var bayname = $("#bayname" + id).html();
                var membername = $("#membername" + id).html();
                var timeStart = $("#timeStart" + id).html();
                var timeEnd = $("#timeEnd" + id).html();
                var timeExtend = $("#timeExtend" + id).html();
                var timeRemain = $("#timeRemain" + id).html();
                $("#heading_modal_inuse").html(bayname);
                $(".memName").html(membername);
                $(".startTime").html(timeStart);
                $(".endTime").html(timeEnd);
                $(".extendedTime").html(timeExtend);
                $(".remainTime").html(timeRemain);
                $("#boxIDforColorChange").val(id);
                $('#busyStatusModal').modal();                     // initialized with defaults
                $('#busyStatusModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#busyStatusModal').modal('hide');
				$("#partymembername").html(adednames);
                hide_load();
                $("#adpartymsg").html('');
                $("#showaddpartypopup").click();
				}else{
					var bayname = $("#bayname" + id).html();
                var membername = $("#membername" + id).html();
                var timeStart = $("#timeStart" + id).html();
                var timeEnd = $("#timeEnd" + id).html();
                var timeExtend = $("#timeExtend" + id).html();
                var timeRemain = $("#timeRemain" + id).html();
                $("#heading_modal_inuse").html(bayname);
                $(".memName").html(membername);
                $(".startTime").html(timeStart);
                $(".endTime").html(timeEnd);
                $(".extendedTime").html(timeExtend);
                $(".remainTime").html(timeRemain);
                $("#boxIDforColorChange").val(id);
                $('#busyStatusModal').modal();                     // initialized with defaults
                $('#busyStatusModal').modal({ keyboard: false });   // initialized with no keyboard
                $('#busyStatusModal').modal('hide');
					existingpurchaseInformation();
				}

            } else {
                //window.location.href = baseUrl;
            }
            hide_load();
        },
        error: function () {
            hide_load();
        }
    });
}
function removeShowresult() {
    show_load();
    var action = 'showsearchresult';
    var searchingresults = $('#searchingresults').val();
    var exist = $('#exist').val();
    var searchArray = searchingresults.substring(1);
    var memberids = $('#memberids').val();
    var memberidsArray = memberids.substring(1);
    $.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, searchArray: searchArray, memberidsArray: memberidsArray},
        type: 'POST',
        beforeSend: function () {
        },
        success: function (result) {
            hide_load();
            $("#showallmembers").html(result);
            $("#showallmemberstwo").html(result);
        },
        error: function () {
        }
    });
}
$(document).on("click", ".removemember", function () {
    var membername = $(this).attr("name");
    var memberid = $(this).attr("id");
    var addmembertotal = $('#addmembertotal').val();
    var showtotaladdedmember = parseInt(addmembertotal) - parseInt("1");
    var searchingresults = $('#memberids').val();
    var searchArray = searchingresults.substring(1);
    var members = searchArray.split(",");
    members.deleteElem = function (val) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] === val) {
                this.splice(i, 1);
                return i;
            }
        }
    };
    var searchingresultsname = $('#searchingresults').val();
    var searchnameArray = searchingresultsname.substring(1);
    var membersname = searchnameArray.split(",");
    membersname.deleteElem = function (val) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] === val) {
                this.splice(i, 1);
                return i;
            }
        }
    };

    var removeids = members.deleteElem(memberid);
    var removename = membersname.deleteElem(membername);
    if (membersname == '' && members == '') {
        document.getElementById('searchingresults').value = '';
        document.getElementById('memberids').value = '';
        document.getElementById('addmembertotal').value = showtotaladdedmember;
        $(".addmorebtn").addClass("hide");
        $(".showtime").addClass("hide");
        removeShowresult();
    } else {
        document.getElementById('searchingresults').value = ',' + membersname;
        document.getElementById('memberids').value = ',' + members;
        document.getElementById('addmembertotal').value = showtotaladdedmember;
        removeShowresult();
    }
});
$(document).on("click", ".removepartyone", function () {
    show_load();
    var waiting_id = $(this).attr("id");
    var siteid = '1';
    var primarygamer = primarygamer;
    $.ajax({
        url: api_url + api_version + "RemoveQueue",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: siteid, waitingid: waiting_id
        },
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.success == true) {
                window.location.href = baseUrl + 'reservations/';
                //window.location.href = baseUrl + 'shooting_lounge/';
                hide_load();
            } else {
                hide_load();
            }

        },
        error: function () {
            hide_load();
        }
    });
});
$(document).on("click", ".bckfst", function () {
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#firststep").removeClass("hide");
    $("#firststep").addClass("show");
});
$(document).on("click", ".bckfirst", function () {
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("show");
    $("#thirdstep").addClass("hide");
    $("#firststep").removeClass("hide");
    $("#firststep").addClass("show");
    $("ul.resp-tabs-list li:nth-child(2)").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(2)").addClass("gobackstep2");
    $("ul.resp-tabs-list li:nth-child(1)").addClass("resp-tab-active");
    $('#secondmenu').attr('onclick', 'secdstep();');
    $("#secondmenu").css("cursor", "pointer");
});
$(document).on("click", ".addmoreplayes", function () {
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#firststep").removeClass("hide");
    $("#firststep").addClass("show");
});
$(document).on("click", ".timeskip", function () {
    getShootingLounges();
    fill_wait_list_grid();
    $("#firststep").removeClass("show");
    $("#firststep").addClass("hide");
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("show");
    $("#thirdstep").addClass("hide");
    $("#forthstep").removeClass("hide");
    $("#forthstep").addClass("show");

    $("ul.resp-tabs-list li:nth-child(1)").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(1)").addClass("gobackstep1");
    $("ul.resp-tabs-list li:nth-child(3)").addClass("resp-tab-active");
    $('#onemenu').attr('onclick', 'onestep();');
    $("#onemenu").css("cursor", "pointer");
});
$(document).on("click", ".timeselect", function () {
    showTimeSelection();
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("hide");
    $("#thirdstep").addClass("show");
    $("ul.resp-tabs-list li:nth-child(1)").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(1)").addClass("gobackstep1");
    $("ul.resp-tabs-list li:nth-child(2)").addClass("resp-tab-active");
    $('#onemenu').attr('onclick', 'onestep();');
    $("#onemenu").css("cursor", "pointer");
});
$(document).on("click", ".showtime", function () {
    var pathname = window.location.pathname; // Returns path only
    var bayid = $("#bayids").val();
    if (pathname.toLowerCase().indexOf("assigntiming") >= 0) {
        existingReservations(bayid);
        //window.location.href = baseUrl;
    } else {
        var totalmemberselect = parseInt($('#totalmember').val());
        var addmembertotal = parseInt($('#addmembertotal').val());
        showTimeSelection();
        $("#secondstep").removeClass("show");
        $("#secondstep").addClass("hide");
        $("#thirdstep").removeClass("hide");
        $("#thirdstep").addClass("show");


        $("ul.resp-tabs-list li:nth-child(1)").removeClass("resp-tab-active");
        $("ul.resp-tabs-list li:nth-child(1)").addClass("gobackstep1");
        $("ul.resp-tabs-list li:nth-child(2)").addClass("resp-tab-active");
        $('#onemenu').attr('onclick', 'onestep();');
        $("#onemenu").css("cursor", "pointer");
    }
});
$(document).on("click", ".showshooting", function () {
    getShootingLounges();
    fill_wait_list_grid();
    $("#firststep").removeClass("show");
    $("#firststep").addClass("hide");
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("show");
    $("#thirdstep").addClass("hide");
    $("#forthstep").removeClass("hide");
    $("#forthstep").addClass("show");

    $("ul.resp-tabs-list li:nth-child(2)").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(2)").addClass("gobackstep2");
    $("ul.resp-tabs-list li:nth-child(3)").addClass("resp-tab-active");
    $('#secondmenu').attr('onclick', 'secdstep();');
    $("#secondmenu").css("cursor", "pointer");
});
$(document).on("click", ".continurassing", function () {
    baySelection();

});

function shownextPop() {
    $(document).on("click", ".nextpop", function () {
        var totalmemberselect = $('#totalmember').val();
        var addmembertotal = $('#addmembertotal').val();
        var showtotalad = parseInt(addmembertotal) - parseInt("1");
        $("#showaddno").html('Only ' + showtotalad + ' out of ' + totalmemberselect + ' players Added');
    });
}
$(document).on("click", ".admobile", function () {
    var waitid = $(this).attr("id");
    var tel = $(this).attr("tel");
    var name = $(this).attr("name");
    document.getElementById('waitID').value = waitid;
    $("#textname").html(name);
    $("#mobiletel").html(tel);
});
$(document).on("click", ".sendtextmsg", function () {
    var sendtext = $('#sendtext:checked').val();
    var waitID = $('#waitID').val();
    $.ajax({
        url: api_url + api_version + "SendSMSMessage",
        headers: {apicode: apiCode, token: user_token},
        data: {waitingid: waitID, sms_type: sendtext},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.success == true) {
                window.location.href = baseUrl + 'reservations/';
            } else {
            }
            hide_load();
        },
        error: function () {
            hide_load();
        }
    });
});
$(document).on("click", ".clear", function () {
    var siteid = '1';
    $.ajax({
        url: api_url + api_version + "ClearQueue",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: siteid},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.success == true) {
                getShootingLounges(); // this will run after every 10 seconds
                fill_wait_list_grid();
                hide_load();
            } else {
                $("#clearmsg").html(result);
                hide_load();
            }
        },
        error: function () {
            hide_load();
        }
    });
});

$(document).on("click", "body", function () {
    $("#clearmsg").html("");
});

$(document).on("click", "#clearWaitlLstYesBtn", function () {
    var siteid = '1';
    $.ajax({
        url: api_url + api_version + "ClearQueue",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: siteid},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.success == true) {
//getShootingLounges(); // this will run after every 10 seconds
                fill_wait_list_grid();
                $('#clearWaitlistModal').modal('hide');
                hide_load();
            } else {
                $("#clearmsg").html(result);
                //$("#modal_WaitListError").html(result);
                $('#clearWaitlistModal').modal('hide');
                hide_load();
            }
        },
        error: function () {
            hide_load();
        }
    });
});

$(document).on("click", ".adtiming", function () {
    var id = $(this).attr("byid");
    var bayname = $("#bayname" + id).html();
    $("#timingname").html(bayname);
    $('#shotingbckpop').attr('bckid', id);
    $('#contpursh').attr('bay', id);
    var totalmember = $('#totalmember').val();
    $.ajax({
        url: api_url + api_version + "TimeSelect?siteid=1&playercount=" + totalmember,
        headers: {apicode: apiCode, token: user_token},
        data: {
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            var time_div = '';
            var unlimitedtime = '';
            time_div += '<div class="bs-example">';
            for (var i = 0; i < result.experiences.length; i++) {
                if (result.experiences[i].id == 3) {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
                } else if (result.experiences[i].id == 8) {
                    unlimitedtime += '<a id="tm' + result.experiences[i].id + '" class="time" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                } else {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                }
            }
            time_div += unlimitedtime;
            time_div += '</div>';
            $("#timetoshow2").html(time_div);
        },
        error: function () {
            hide_load();
        }
    });

    $("#showtimingpop").click();
});
$(document).on("click", ".directadtiming", function () {
    var id = $(this).attr("byid");
    var reservation = $(this).attr("reservation");
    var bayname = $("#bayname" + id).html();
    $("#timingname").html(bayname);
    $('#shotingbckpop').attr('bckid', id);
    $('#contpursh').attr('bay', id);
    var totalmember = $(this).attr("totalmembers");
    $.ajax({
        url: api_url + api_version + "TimeSelect?siteid=1&playercount=" + totalmember,
        headers: {apicode: apiCode, token: user_token},
        data: {
        },
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            var time_div = '';
            var unlimitedtime = '';
            time_div += '<div class="bs-example">';
            for (var i = 0; i < result.experiences.length; i++) {
                if (result.experiences[i].expname == '1 Hour') {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time current" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                    document.getElementById('expId').value = result.experiences[i].id;
                } else if (result.experiences[i].expname == 'Unlimited') {
                    unlimitedtime += '<a id="tm' + result.experiences[i].id + '" class="time" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                } else {
                    time_div += '<a id="tm' + result.experiences[i].id + '" class="time" time="' + result.experiences[i].expname + '" rel="' + result.experiences[i].id + '"><button type="button" id="nextbtn" class="btn btn-default activess' + result.experiences[i].id + '">' + result.experiences[i].expname + ' </button></a>';
                }
            }
            time_div += unlimitedtime;
            time_div += '</div>';
            $("#timetoshow2").html(time_div);
            $("#showtimeselect2").html("1 Hour has been selected, please click Continue");
            document.getElementById('reservationId').value = reservation;
        },
        error: function () {
            hide_load();
        }
    });

    $("#showtimingpop").click();
});
$(document).on("click", ".shootingloungbackpop", function () {
    var id = $(this).attr("bckid");
    rclicked(id);
});
$(document).on("click", ".gopurchs", function () {
    var id = $(this).attr("bay");
    var expId = $('#expId').val();
    var expTime = $('#expTime').val();
    var games = $('#gamers').val();
    var bayname = $("#bayname" + id).html();
    $("#pushname").html(bayname);
    var bayid = id;
    $.ajax({
        url: api_url + api_version + "AddTimePurchaseInformation?siteid=1&bayid=" + id + "&expid=" + expId,
        headers: {apicode: apiCode, token: user_token},
        data: {},
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            $('#finshpop').attr('byid', id);
            var showTime = '';
            if (expId == '1') {
                showTime = '30 Mins';
            } else if (expId == '3') {
                showTime = '1 Hour';
            } else if (expId == '4') {
                showTime = '1 Hour 30 Mins';
            } else if (expId == '5') {
                showTime = '2 Hours';
            } else if (expId == '6') {
                showTime = '2 Hours 30 Mins';
            } else if (expId == '7') {
                showTime = '3 Hours';
            } else if (expId == '9') {
                showTime = '30 Mins Upgrade';
            } else if (expId == '10') {
                showTime = '1 Hour Upgrade';
            } else if (expId == '11') {
                showTime = '1 Hour 30 Mins Upgrade';
            } else if (expId == '12') {
                showTime = '2 Hours Upgrade';
            } else if (expId == '13') {
                showTime = '2 Hours 30 Mins Upgrade';
            } else if (expId == '14') {
                showTime = '3 Hours Upgrade';
            } else if (expId == '8') {
                showTime = 'Unlimited';
            }
            var showmemberInfo = '';
            showmemberInfo += '<div class="order" data-order-summary-section="payment-lines">';
            showmemberInfo += '<table class="purchasetable">';
            showmemberInfo += '<tr><th class="cost">Cost</th><th class="desc">Description</th></tr>';
            if(expTime != "") {
                showmemberInfo += '<tr><td>Refer to POS machine</td><td>' + result.bay_name + '&nbsp;(' + expTime + ')</td></tr>';
            } else {
                showmemberInfo += '<tr><td>Refer to POS machine</td><td>' + result.bay_name +'</td></tr>';
            }
            //showmemberInfo += '<tr><td>Refer to POS machine</td><td>' + result.bay_name + '&nbsp;(' + expTime + ')</td></tr>';
            showmemberInfo += '</table>';
            showmemberInfo += '<br><h5 class="dot"></h5>';
            showmemberInfo += '<br><h5 class="line"></h5><br>';
            showmemberInfo += '</div>';
            hide_load();
            $("#showinfopurshpop").html(showmemberInfo);
        },
        error: function () {
            $("#showinfopurshpop").html('Bay is not available');
            hide_load();
        }
    });
    $("#showpurshspop").click();
});
$(document).on("click", ".fshpops", function () {
    var id = $(this).attr("byid");
    var expId = $('#expId').val();
    var bayid = id;
    $.ajax({
        url: api_url + api_version + "AddTimePurchaseInformation",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: "1", bayid: id, expid: expId},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.status == true) {
                $("#firstscreen").css("display", "none");
                $("#closeBtnStatusopen").css("display", "none");
                $("#assignBtn").css("display", "none");
                $("#deactivatBtn").css("display", "none");
                $('#timingpop').modal('hide');
                lastFocus(id);
            } else {
                $("#showinfopurshpop").html('Bay is not available');
            }
        },
        error: function () {
            $("#showinfopurshpop").html('Bay is not available');
            hide_load();
        }
    });
    $("#showpurshspop").click();
});
$(document).on("click", ".existingparty", function () {
    var id = $(this).attr("by_id");
    var bay_name = $(this).attr("bay_name");
    var searchingresults = $('#memberids').val();
    var searchArray = searchingresults.substring(1);
    var members = searchArray.split(",");
    var searchingresultsname = $('#searchingresults').val();
    var searchArrayname = searchingresultsname.substring(1);
    var membersname = searchArrayname.split(",");
	var paid_unpaid = $('#paid_unpaid').val();
    var adednames = '';
    $.ajax({
        url: api_url + api_version + "ExistingReservation",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: '1', bayid: id, gamertag: members},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.issuccessful == true) {
				if(paid_unpaid == 'true'){
                adednames += '<ul class="adname">';
                for (var i = 0; i < membersname.length; i++) {
                    adednames += '<li><b>' + membersname[i] + '</b> has been added to ' + bay_name + '</li>';
                }
                adednames += '</ul>';
                $('#busyStatusModal').modal('hide');
                $("#partymembername").html(adednames);
                hide_load();
                $("#adpartymsg").html('');
                $("#showaddpartypopup").click();
				//window.location.href = baseUrl;
				}else{
					$('#busyStatusModal').modal('hide');
					existingpurchaseInformation();
				}
            }else {
				//window.location.href = baseUrl;
            }
            hide_load();
        },
        error: function () {
            $("#partymaxpop").click();
            $('#busyStatusModal').modal('hide');
            hide_load();
        }
    });

//existingReservations(id);	
});

$(document).on("click", ".disab", function () {
    $("#partymaxpop").click();
});
$(document).on("click", ".showshootingpop", function () {
    $("#shootpopup").click();
});
$(document).on("click", ".checkpassword", function () {
    show_load();
    var action = 'checkpass';
    var userpass = $('#userpass').val();
    if (userpass == '') {
        $("#passerror").html('<span style="color:#F00">Password is required</span>');
        hide_load();
    } else {
        $.ajax({
            url: baseUrl + "checkinmember/process",
            data: {action: action, userpass: userpass},
            type: 'POST',
            beforeSend: function () {
            },
            success: function (result) {
                if (result == 'MoRo@357') {
                    $("#passerror").html('');
                    $('#shootingpop').modal('hide');
                    getShootingLounges();
                    fill_wait_list_grid();
                    $("#firststep").removeClass("show");
                    $("#firststep").addClass("hide");
                    $("#secondstep").removeClass("show");
                    $("#secondstep").addClass("hide");
                    $("#thirdstep").removeClass("show");
                    $("#thirdstep").addClass("hide");
                    $("#forthstep").removeClass("hide");
                    $("#forthstep").addClass("show");
                    $("ul.resp-tabs-list li:nth-child(2)").removeClass("resp-tab-active");
                    $("ul.resp-tabs-list li:nth-child(2)").addClass("gobackstep2");
                    $("ul.resp-tabs-list li:nth-child(3)").addClass("resp-tab-active");
                    $('#secondmenu').attr('onclick', 'secdstep();');
                    $("#secondmenu").css("cursor", "pointer");
                    hide_load();
                } else {
                    $("#passerror").html('<span style="color:#F00">Please enter a valid password</span>');
                    hide_load();
                }
            },
            error: function () {
                hide_load();
            }
        });
    }
});
function onestep() {
    $("#firststep").removeClass("hide");
    $("#firststep").addClass("show");
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("show");
    $("#thirdstep").addClass("hide");
    $("#forthstep").removeClass("show");
    $("#forthstep").addClass("hide");
    $("#fifthstep").removeClass("show");
    $("#fifthstep").addClass("hide");
    $("ul.resp-tabs-list li").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(1)").addClass("resp-tab-active");
}
function secdstep() {
    $("#firststep").removeClass("show");
    $("#firststep").addClass("hide");
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("hide");
    $("#thirdstep").addClass("show");
    $("#forthstep").removeClass("show");
    $("#forthstep").addClass("hide");
    $("#fifthstep").removeClass("show");
    $("#fifthstep").addClass("hide");
    $("ul.resp-tabs-list li").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(2)").addClass("resp-tab-active");
}
function thirdstep() {
    $("#firststep").removeClass("show");
    $("#firststep").addClass("hide");
    $("#secondstep").removeClass("show");
    $("#secondstep").addClass("hide");
    $("#thirdstep").removeClass("show");
    $("#thirdstep").addClass("hide");
    $("#forthstep").removeClass("hide");
    $("#forthstep").addClass("show");
    $("#fifthstep").removeClass("show");
    $("#fifthstep").addClass("hide");
    $("ul.resp-tabs-list li").removeClass("resp-tab-active");
    $("ul.resp-tabs-list li:nth-child(3)").addClass("resp-tab-active");
}

function hide_loader() {
   // jQuery('#fancybox-loading').css('display', 'none');
   // jQuery('#fancybox-overlay').css('display', 'none');
   $('#status').fadeOut();
   $('#preloader').delay(350).fadeOut('slow');
}
function check_loginDb() {
	//alert("sfsdf");
    var action = jQuery('#action').val();
    var username = jQuery('#username').val();
    var userpassword = jQuery('#userpassword').val();
    var remember = jQuery('#remember:checked').val();
    if (username == '' || userpassword == '') {
        $("#loginerror").html('<span style="color:#F00">Enter a valid username/password</span>');
        hide_loader();
    } else {
        $.ajax({
            url: api_url + api_version + "AdminLogin",
            headers: {apicode: apiCode},
            data: {username: username, password: userpassword},
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (result) {
                //alert(result.token);
				 
                if (result.status == true) {
                    $("#loginerror").html('');
                    user_login(action, username, userpassword, remember, result.token);
                    hide_loader();
					 //$('#preloader').delay(350).fadeOut('slow');$('#status').fadeOut();
                } else if (result.status == false) {
                    $("#loginerror").html('<span style="color:#F00">Enter a valid username/password</span>');
                    hide_loader();
					 //$('#preloader').delay(350).fadeOut('slow');$('#status').fadeOut();
                }
            },
            error: function () {
                $("#loginerror").html('<span style="color:#F00">Enter a valid username/password</span>');
                hide_loader();
            }
        });
    }
}
function user_login(action, user, pass, remeber, token) {
    show_load();
    var action = action;
    var username = user;
    var userpassword = pass;
    var remember = remeber;
    var token = token;
    var check_remeber = '';
    if (remember) {
        check_remeber = 1;
    } else {
        check_remeber = 0;
    }
    var formid = document.getElementById('loginForm');
    jQuery.ajax({
        url: baseUrl + "checkinmember/process",
        data: {action: action, username: username, userpassword: userpassword, remember: check_remeber, token: token},
        type: 'POST',
        timeout: 10000,
        success: function (data) {
            if (data == 'logincorrect') {
                window.location.href = baseUrl;
                hide_load();
            } else {
                $("#loginerror").html('<span style="color:#F00">Enter a valid username/password</span>');
                hide_load();
            }

        },
        error: function () {
            hide_load();
            showMessage('#fff', '#000000', 'Thanking them for their order and a representative will be in contact shortly to confirm the order.');
        }
    });
}
function showMessage(bgcolor, color, msg) {
    if (!jQuery('#smsg').is(':visible')) {
        jQuery('html, body').animate({
            scrollTop: 0
        }, 500, function () {
            if (!jQuery('#smsg').length) {
                jQuery('<div id="smsg">' + msg + '</div>').appendTo(jQuery('body')).css({
                    position: 'fixed',
                    top: 0,
                    left: 0,
                    width: '100%',
                    height: '90px',
                    lineHeight: '30px',
                    background: bgcolor,
                    color: color,
                    zIndex: 1000,
                    padding: '10px',
                    fontWeight: 'bold',
                    textAlign: 'center',
                    fontSize: '22px',
                    opacity: 0.8,
                    margin: 'auto',
                    display: 'none'
                }).slideDown('show');

                setTimeout(function () {
                    jQuery('#smsg').animate({'width': 'hide'}, function () {
                        jQuery('#smsg').remove();
                    });
                }, 8000);
            }
        });
    }
}

// input2search
$(document).on("keydown", "input[type=search]", function (e) {
    //alert(e.keyCode);
    if (e.keyCode == 9) {   // If pressed TAB (9) then focus on first row
        $('table#example tr:first-child').click();

    }
});

$(document).on("keydown", "#qrcode", function (e) {
//    alert(e.keyCode);
    if (e.keyCode == 8) {   // If pressed TAB (9) then focus on first row
        $(this).val("");
    }
});

$(document).on("keydown", "#qrcode", function (e) {
//    alert(e.keyCode);
    if (e.keyCode == 8) {   // If pressed TAB (9) then focus on first row
        $(this).val("");
    }
});
$(document).on("click", "body", function (e) {
    $("#notqr").html('');
});

$(document).on("keydown", "table#example tr", function (e) {

    //alert(e.keyCode);
    if (e.keyCode == 13) {   // If pressed DOWN (40) then focus on first row
        //alert($(this).attr('id'));

    } else if (e.keyCode == 40) {   // If pressed DOWN (40) then focus on first row
        //$(this).closest('tr').click();
        $(this).next('tr').find('td').click();

    } else if (e.keyCode == 38) {   // If pressed UP (38) then focus on first row
        $(this).closest('tr').click();

    }
});


function show_load() {
    jQuery('#fancybox-loading').css('display', 'block');
    jQuery('#fancybox-overlay').css('display', 'block');
}

function hide_load() {
    jQuery('#fancybox-loading').css('display', 'none');
    jQuery('#fancybox-overlay').css('display', 'none');
}



$(document).on("keyup", "div.dataTables_filter input[type=search]", function (e) {
    if (e.keyCode == 8) {
        this.value = "";

    }
});
$(document).on("click", "div.dataTables_filter input[type=search]", function (e) {

    if (this.value != "") {
        this.value = "";
    }
});

$(document).on("blur", ".leftBayGroup", function(e){
    var fieldValue = this.value;
    /*if(fieldValue == "") {
     fieldValue = "Left Section";
     }*/
    updateBayHeaders(1,fieldValue);
});
$(document).on("keyup", ".leftBayGroup", function(e){
    if(e.keyCode == 13) {
        this.blur();
    }
});

$(document).on("blur", ".rightBayGroup", function(e){
    var fieldValue = this.value;
    /*if(fieldValue == "") {
     fieldValue = "Right Section";
     }*/
    updateBayHeaders(3,fieldValue);
});
$(document).on("keyup", ".rightBayGroup", function(e){
    if(e.keyCode == 13) {
        this.blur();
    }
});
$(document).on("blur", ".middleBayGroup", function(e){
    var fieldValue = this.value;
    /*if(fieldValue == "") {
     fieldValue = "Middle Section";
     }*/
    updateBayHeaders(2,fieldValue);
});
$(document).on("keyup", ".middleBayGroup", function(e){
    if(e.keyCode == 13) {
        this.blur();
    }
});

$(document).on("focus", "#qrcode", function(e){
    $(this).val("");
});

function checkTimeAddLeadingZero(i) {
    if (i < 10) {i = "0" + parseInt(i).toString(); };  // add zero in front of numbers < 10
    return i;
}

function Timerstart(id, hours, minuts, seconds) {

    //alert(id+" "+parseInt(hours)+" "+minuts+" "+seconds);

    if(hours == 0 && minuts == 0 && seconds == 0) {
        return false;
    }

    var counter;
    var hours = hours;
    var minutes = minuts;
    var seconds = seconds;

    counter = setInterval(function () {

        if(parseInt(seconds) < 0 && parseInt(minutes) > 0) {
            seconds = 59;
        }
        if(parseInt(minutes) < 0) {
            minutes = 59;
        }

        if(parseInt(seconds) == 0) {
            minutes--;
        }
        if(parseInt(minutes) == 0) {
            hours--;
            if(parseInt(hours) < 0) {
                hours = 0;
            }
        }


        if($("#box" + id).hasClass('use')) {
            if(parseInt(hours) == 0 && parseInt(minutes) < 5  && parseInt(minutes) >= 0) {
                $("#box" + id).removeClass('use');
                $("#box" + id).addClass('inUseYellow');
            }
        }

        var minutesString = checkTimeAddLeadingZero(parseInt(minutes));
        var secondsString = checkTimeAddLeadingZero(parseInt(seconds));
        var hoursString = checkTimeAddLeadingZero(parseInt(hours));

        if(parseInt(hoursString) == 0 && parseInt(minutesString) == 0 && parseInt(secondsString) == 0) {
            document.getElementById("timeRemain" + id).innerHTML = "00:00:00";
            $("#box" + id).removeClass('inUseYellow');
            $("#box" + id).addClass('actionneeded');
            clearInterval(counter);
            return;
        }

        document.getElementById("timeRemain" + id).innerHTML = hoursString + ":" + minutesString + ":" + secondsString;
        seconds--;
    }, 1000);
}


function timercountdown(id, S) {
    var totalSeconds = parseInt(S);

    if(totalSeconds <= 0) {
        $('#timeRemain'+id).html("00:00:00");
        return;
    }

    var interval = setInterval(function() {

        totalSeconds--;
        if(totalSeconds <= 0) {
            $('#timeRemain'+id).html("00:00:00");
            clearInterval(interval);
        }

        var hours   = Math.floor(totalSeconds / 3600 );
        var minutes = Math.floor(totalSeconds % 3600 / 60);
        var seconds = totalSeconds % 60;

        if($("#box" + id).hasClass('use')) {
            if(totalSeconds <= 300 && totalSeconds > 0) {
                $("#box" + id).removeClass('use');
                $("#box" + id).addClass('inUseYellow');
            }
        }
        if($("#box" + id).hasClass('inUseYellow')) {
            if(totalSeconds <= 0) {
              $("#box" + id).removeClass('inUseYellow');
                $("#box" + id).addClass('actionneeded');
				$("#box" + id).addClass('blink_me');
                //clearInterval(interval);
            }
        }

        var hour_text = (parseInt(hours) < 10 ? hours='0'+parseInt(hours) : hours);
        var minute_text = (parseInt(minutes) < 10 ? minutes='0'+parseInt(minutes) : minutes);
        var second_text = (parseInt(seconds) < 10 ? seconds='0'+parseInt(seconds) : seconds);

        var result = hour_text + ":" + minute_text + ":" + second_text;
        $('#timeRemain'+id).html(result);

    }, 1000);
}

function countdownTimerVishal(element, hours, minutes, seconds) {
    // Fetch the display element
    //var el = document.getElementById("timeRemain"+element);

    // Set the timer
    var interval = setInterval(function() {

        if(seconds == 0) {
            if(minutes == 0) {
                if(hours == 0) {
                    $("#timeRemain"+element).html("00:00:00");

                    clearInterval(interval);
                    interval = null;
                    return;
                } else {
                    hours--;
                    minutes = 60;
                }
            } else {
                minutes--;
                seconds = 60;
            }
        }

        if($("#box" + element).hasClass('use')) {
            if(parseInt(hours) == 0 && parseInt(minutes) < 5  && parseInt(minutes) >= 0) {
                $("#box" + element).removeClass('use');
                $("#box" + element).addClass('inUseYellow');
            }
        }

        if($("#box" + element).hasClass('inUseYellow')) {
            if(parseInt(hours) == 0 && parseInt(minutes) == 0  && parseInt(seconds) == 0) {
                $("#box" + element).removeClass('inUseYellow');
                $("#box" + element).addClass('actionneeded');
                clearInterval(interval);
            }
        }

        var hour_text = (hours < 10 ? hours='0'+parseInt(hours) : hours);
        var minute_text = (minutes < 10 ? minutes='0'+parseInt(minutes) : minutes);
        var second_text = (seconds < 10 ? seconds='0'+parseInt(seconds) : seconds);

        if(second_text == "60") {
            second_text = "00";
        }

        if(minute_text == "60") {
            minute_text = "00";
        }

        if(hour_text == "60") {
            hour_text = "00";
        }

        //el.innerHTML = hour_text + ':' + minute_text + ':' + second_text;
        $("#timeRemain"+element).html(hour_text + ':' + minute_text + ':' + second_text);
        seconds--;
    }, 1000);
}

/* Reservation Javascript Work Start */

$(document).on("click", ".reservationRemoveBtn", function () {
    var rescode = $(this).attr("id");
    var phone = $(this).attr("phone");
    var name = $(this).attr("name");
    var fname = $(this).attr("fname");
    var lname = $(this).attr("lname");
    var pSize = $(this).attr("pSize");
    var resTime = $(this).attr("resTime");
    var restId = $(this).attr("restId");
    var restOcc = $(this).attr("restOcc");
    var email = $(this).attr("email");

    $("#modal_ResName").html("Name: "+name);
    $("#modal_pSize").html("Party Size: "+pSize);
    $("#modal_ResTime").html("Reservation Time: "+resTime);
    $("#modal_ResPhone").html("Phone Number: "+phone);
    $("#modal_ResOccasion").html("Occasion: "+restOcc);

    $("#restId").val(restId);
    $("#resCode").val(rescode);
    $("#fName").val(fname);
    $("#lName").val(lname);
    $("#ReserEmail").val(email);
    $("#ReserPhone").val(phone);

    $("#modal_ResError").html("");
});


$(document).on("click", "#resIsCancelledBtn", function () {
    var restId = $("#restId").val();
    var resCode = $("#resCode").val();
    $.ajax({
        url: baseUrl + "reservations/cancelReservation",
        data: { resCode: resCode /*, fName: fName, lName: lName, email: email, phone: phone, status: status */},
        type: "POST",
        dataType : 'json',
        beforeSend: function () {
            $('#resIsCancelledBtn').prop('disabled', true);
            $('#resIsNoShowBtn').prop('disabled', true);
        },
        success: function (result) {
            reservationLog("Canceled");
            $('#resIsCancelledBtn').prop('disabled', false);
            $('#resIsNoShowBtn').prop('disabled', false);
        },
        error: function () {
            $("#modal_ResError").html("Error while cancelling the reservation");
        }
    });
});

$(document).on("click", "#resIsNoShowBtn", function () {
    var restId = $("#restId").val();
    var resCode = $("#resCode").val();
    /*
    var fName = $("#fName").val();
    var lName = $("#lName").val();
    var email = $("#ReserEmail").val();
    var phone = $("#ReserPhone").val();
    var status = "noshow";
*/
    $.ajax({
        url: baseUrl + "reservations/cancelReservation",
        data: { resCode: resCode },
        type: "POST",
        dataType : 'json',
        beforeSend: function () {
        },
        success: function (result) {
            reservationLog("No Show");
        },
        error: function () {
            $("#modal_ResError").html("Error while cancelling the reservation");
        }
    });
});

function reservationLog (status_show_cancel) {
    var resCode = $("#resCode").val();
    var fName = $("#fName").val();
    var lName = $("#lName").val();
    var email = $("#ReserEmail").val();
    var phone = $("#ReserPhone").val();
    var status = status_show_cancel;

    $.ajax({

        url: api_url + api_version + "ReservationLog",
        headers: {apicode: apiCode, token: user_token},
        data: { reservationCode: resCode, firstname: fName, lastname: lName, emailaddress: email, phone: phone, status: status },
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },

        success: function (result) {
            getReservations();
            $('#removeReservation').modal('hide');
        },
        error: function () {
            //$("#modal_ResError").html("Error while cancelling the reservation");
            getReservations();
            $('#removeReservation').modal('hide');
        }
    });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function reservationCheckInWaitList(status_checkin_waitlist) {
    var resCode = $("#ResCodeTxt").val();

    $.ajax({
        url: baseUrl + "reservations/confirmReservation",
        data: { resCode: resCode },
        type: "POST",
        dataType : 'json',
        beforeSend: function () {
        },
        success: function (result) {
            reservationLogCheckInWaitList(status_checkin_waitlist);
        },
        error: function () {
        }
    });
}

function reservationLogCheckInWaitList (status_show_cancel) {
    var resCode = $("#ResCodeTxt").val();
    var fName = $("#ResFirstNameTxt").val();
    var lName = $("#ResLastNameTxt").val();
    var email = $("#ResEmailTxt").val();
    var phone = $("#ResPhoneTxt").val();
    var status = status_show_cancel;

    $.ajax({
        url: api_url + api_version + "ReservationLog",
        headers: {apicode: apiCode, token: user_token},
        data: { reservationCode: resCode, firstname: fName, lastname: lName, emailaddress: email, phone: phone, status: status },
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            if(status_show_cancel != "Check-In")
                window.location.href = baseUrl;
        },
        error: function () {
            if(status_show_cancel != "Check-In")
                window.location.href = baseUrl;
        }
    });
}

var reservationDeletedCount = 0;

$(document).on("click", "#clearReservationListYesBtn", function () {

    var firstNameList = $("#ResFNameList").val();
    var lastNameList = $("#ResLNameList").val();
    var phoneList = $("#ResPhoneList").val();
    var emailList = $("#ResEmailList").val();
    var resCodeList = $("#ResCodeList").val();

    var firstNameListArray = firstNameList.split(",");
    var lastNameListArray = lastNameList.split(",");
    var phoneListArray = phoneList.split(",");
    var emailListArray = emailList.split(",");
    var resCodeListArray = resCodeList.split(",");

    var totalRecords = resCodeListArray.length;

    show_load();

    for (var i = 0; i < totalRecords; i++) {
        reservationClearReservationList(firstNameListArray[i],lastNameListArray[i],phoneListArray[i],emailListArray[i],resCodeListArray[i],"Canceled", totalRecords);
    }


});

function reservationClearReservationList(fname,lname,phone,email,rescode,status,totalrec) {
    var resCode = rescode;

    $.ajax({
        url: baseUrl + "reservations/cancelReservation",
        data: { resCode: resCode },
        type: "POST",
        dataType : 'json',
        beforeSend: function () {
        },
        success: function (result) {
            clearReservationListLog(fname,lname,phone,email,rescode,status,totalrec);
        },
        error: function () {
        }
    });
}

function clearReservationListLog(fname,lname,phone,email,rescode,status,totalrec) {
    var resCode = rescode;
    var fName = fname;
    var lName = lname;
    var email = email;
    var phone = phone;
    var status = status;

    $.ajax({

        url: api_url + api_version + "ReservationLog",
        headers: {apicode: apiCode, token: user_token},
        data: { reservationCode: resCode, firstname: fName, lastname: lName, emailaddress: email, phone: phone, status: status },
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (result) {
            reservationDeletedCount = reservationDeletedCount+1;
            if(reservationDeletedCount == totalrec) {
                getReservations();
                $('#clearReservationModal').modal('hide');
                hide_load();
            }
        },
        error: function () {
            reservationDeletedCount = reservationDeletedCount+1;
            if(reservationDeletedCount == totalrec) {
                getReservations();
                $('#clearReservationModal').modal('hide');
                hide_load();
            }
        }
    });
}


/* Reservation Javascript Work End */

function noActionFunc(whatever) {
        return;
}


/*      Unlimited Timer Functions       */

var fourth99 = 99;
var third99 = 99;
var second99 = 99;
var first99 = 99;
function unlimitedTimer(bayid) {
    var id = bayid;
    var everyinterval = 0;

    everyinterval = setInterval(function () {
        //var fourth99 = 99; //$("#fourth99" + id).html();
        fourth99--;
        if (fourth99 < 10) {
            fourth99 = "0" + fourth99;
        }
        $("#fourth99" + id).html(fourth99);
        var newfourth99 = fourth99; //$("#fourth99" + id).html();
        if (newfourth99 == 0) {
            minusthird99(id);
            fourth99 = 99;
            $("#fourth99" + id).html("99");
        }
    }, 1000);
}

function minusthird99(bayid) {
    var id = bayid;
    //var third99 = $("#third99" + id).html();
    third99--;
    if (third99 < 10) {
        third99 = "0" + third99;
    }
    $("#third99" + id).html(third99);
    var newthird99 = third99;// $("#third99" + id).html();
    if (newthird99 == 0) {
        minussecond99(id);
        third99 = 99;
        $("#third99" + id).html(99);
    }
}

function minussecond99(bayid) {
    var id = bayid;
    //var second99 = $("#second99" + id).html();
    second99--;
    if (second99 < 10) {
        second99 = "0" + second99;
    }
    $("#second99" + id).html(second99);
    var newsecond99 = second99; // $("#second99" + id).html();
    if (second99 == 0) {
        minusfirst99(id);
        second99 = 99;
        $("#second99" + id).html(99);
    }
}

function minusfirst99(bayid) {
    var id = bayid;
    //var first99 = $("#first99" + id).html();
    first99--;
    if (first99 < 10) {
        first99 = "0" + first99;
    }
    $("#first99" + id).html(first99);
}

/*      Unlimited Timer functions End   */

function removeMember(members, bayid) {
    $.ajax({
        url: api_url + api_version + "MemberSLTransfer",
        headers: {apicode: apiCode, token: user_token},
        data: {oldbayid: bayid, gamertag: members},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.issuccessful == true) {
                window.location.href = baseUrl+"assign";
                //$("#memberTransferError").html("Server Error: Please try again");
                //$("#memberTransferError").show().delay(3000).fadeOut();

            }else {
                //alert("error");
                $("#memberTransferError").html("Server Error: Please try again");
                $("#memberTransferError").show().delay(3000).fadeOut();
                //$("#memberTransferError").fadeIn('slow').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
            }
            hide_load();
        },
        error: function (e) {
            //alert("Server Error Please Try again");
            $("#memberTransferError").html("Server Error: Please try again");
            $("#memberTransferError").show().delay(3000).fadeOut();
            //$("#memberTransferError").fadeIn('slow').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
            hide_load();
        }
    });
}
function assignMembertoBay(members, bayid, oldbayid) {
    $.ajax({
        url: api_url + api_version + "ExistingReservation",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: '1', bayid: bayid, gamertag: members},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function () {
            show_load();
        },
        success: function (result) {
            if (result.issuccessful == true) {
                //window.location.href = baseUrl+"assign";
                hide_load();
                removeMember(members, oldbayid);
            } else {
                //alert("error");
                $("#memberTransferError").html("Server Error: Please try again");
                $("#memberTransferError").show().delay(3000).fadeOut();
            }
            hide_load();
        },
        error: function (e) {
            var str = e.responseText;
            if (str.toLowerCase().indexOf("6 members") >= 0) {
                var SLText = $('select[id="SLsInUse"] option:selected').html();
                $("#memberTransferError").html(SLText+" already has a maximum of 6 members assigned.");
                $("#memberTransferError").show().delay(3000).fadeOut();
            } else {
                $("#memberTransferError").html("Server Error: Please try again");
                $("#memberTransferError").show().delay(3000).fadeOut();
            }

            hide_load();
        }
    });
}

/*function api_check_user_permission() {
    $.ajax({
        url: api_url + api_version + "userpermission?username=" + userloginname,
        headers: {},
        data: {},
        type: 'GET',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(result) {
            //alert(result[0]['PermissionName']);

            var page = "";

            var pathname = window.location.pathname; // Returns path only

            if (pathname.toLowerCase().indexOf("assign") >= 0) {
                page = "checkinapp-shootinglounges";
            } else if (pathname.toLowerCase().indexOf("checkinmember") >= 0) {
                page = "checkinapp-memberscheckin";
            } else if (pathname.toLowerCase().indexOf("reservations") >= 0) {
                page = "checkinapp-waitlist";
            }

            var allow = 0;

            //var arr = [];
            $.each(result, function(j, item) {
                //arr[j] = result[j]['PermissionName'];
                if(result[j]['PermissionName'] == page) {
                    allow = 1;
                }

            });
            for(var i=0; i<result.length;i++) {
                if(result[i]['PermissionName'] == page) {
                    allow = 1;
                    break;
                }
            }

            if(allow != 1) {
                window.location.href = baseUrl;
            }

        }, error: function(e) {

        }
    });
}*/
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}
function user_permission(){
$.ajax({
url: api_url + api_version + "userpermission?username=" + userloginname,
headers: {},
data: {},
type: 'GET',
crossDomain: true,
dataType: 'json',
beforeSend: function() {

},
success: function(result) {
var arr = [];
$.each(result, function(j, item) {
arr[j] = result[j]['PermissionName'];
});
if(isInArray('checkinapp-memberscheckin',arr) == true){
$('#userpermission_checkinmemberpage').attr('permission', 'checkinmember');
page_permision_checkinmember('checkinmember');
}
if(isInArray('checkinapp-shootinglounges',arr) == true){
$('#userpermission_assign').attr('permission', 'assign');
page_permision_assign('assign');
}
if(isInArray('checkinapp-waitlist',arr) == true){
$('#userpermission_reservation').attr('permission', 'reservations');
page_permision_waitlist('reservations');
}
}, error: function(e) {
}
});
}
function page_permision_checkinmember(pagename0){
var action = 'accesscheckin';	
var pagename0 = pagename0;
$.ajax({
url: baseUrl + "checkinmember/process",
data: {action: action, pagename0: pagename0},
type: 'POST',
beforeSend: function () {
},
success: function (result) {
},
error: function () {
}
});	
}
function page_permision_assign(pagename1){
var action = 'accessassign';	
var pagename1 = pagename1;
$.ajax({
url: baseUrl + "assign/process",
data: {action: action, pagename1: pagename1},
type: 'POST',
beforeSend: function () {
},
success: function (result) {
},
error: function () {
}
});	
}
function page_permision_waitlist(pagename2){
var action = 'accesswaitlist';	
var pagename2 = pagename2;
$.ajax({
url: baseUrl + "reservations/process",
data: {action: action, pagename2: pagename2},
type: 'POST',
beforeSend: function () {
},
success: function (result) {
},
error: function () {
}
});	
}

$(document).on("click", ".checkpermision", function () {
var permision = $(this).attr("permission");
if(permision != 'notallow'){
		window.location.href = baseUrl+permision;		
}else{
$('#permisionpopup').click();
}
});
	
function waitlist_reorder(new_position, old_position) {
    $.ajax({
        url: api_url + api_version + "WaitingQueue",
        headers: {apicode: apiCode, token: user_token},
        data: {siteid: '1', new_position: new_position, old_position: old_position},
        type: 'POST',
        crossDomain: true,
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(result) {
           fill_wait_list_grid();

        }, error: function(e) {
            return false; //alert("Server Error Please try again");
        }
    });
}


startCropper: function () {
      var _this = this;
      if (this.active) {
        this.$img.cropper('replace', this.url);
        //alert('one');
      } else {
        //alert(this.url);
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper({
          aspectRatio: this.$cropWidth / this.$cropHeight * 1,
          preview: this.$avatarPreview.selector,
          strict: false,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height":' + e.height,
                  '"width":' + e.width,
                  '"rotate":' + e.rotate + '}'
                ].join();

            _this.$avatarData.val(json);
          }
        });

        this.active = true;
      }

      this.$avatarModal.one('hidden.bs.modal', function () {
        _this.$avatarPreview.empty();
        _this.stopCropper();
      });
    }