// Login Mecha
$('#formLogin').on('submit', function(e) {
  $('#btnSignin').prop("disabled", true);
  $("#btnSignin").html('Loading ...');
  $('#txtUname').prop('readonly', true);
  $('#txtPword').prop('readonly', true);
  var raw = $('#rawdata').val();
  e.preventDefault();
  $.ajax({
      type: 'POST',
      url: 'content/action/formlogin.php',
      data: $('#formLogin').serialize(),
      success: function(data) {
        Cookies.set("appid", 0);
        Push.create("ZestCARs", {
          body: data,
          icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
          timeout: 4000,
          onClick: function() {
            window.focus();
            this.close();
          },
          onClose: function() {
            window.location.href = '';
          },
        });
      }
  });
});
// Register Mecha
$('#formSignup').on('submit', function(e) {
  $('#btnRegister').prop("disabled", true);
  $("#btnRegister").html('Loading ...');
  $('#txtUname').prop('readonly', true);
  $('#txtPword').prop('readonly', true);
  var raw = $('#rawdata').val();
  e.preventDefault();
  $.ajax({
      type: 'POST',
      url: 'content/action/formregister.php',
      data: $('#formSignup').serialize(),
      success: function(data) {
          Push.create("ZestCARs", {
              body: data,
              icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
              //timeout: 4000,
              onClick: function() {
                  window.focus();
                  this.close();
              },
              onClose: function() {
                  window.location.href = '';
              },
          });
      }
  });
});
$(document).ready(function () {
  if (window.location.href.indexOf("pages") > -1) {
    var appid = Cookies.get('appid');
    var uid = $('#uid').val();
    if (appid) { $("#bodyid").val(appid); contentloader(appid); }
    // Get Employee information
    $.ajax({
      type: "GET",
      url: '../../content/action/getEinfo.php?euid=' + uid,
      success: function(data) {
        var udata = data.split(",");
        $('.user-name').text(udata[0] + ' ');
        $('.user-role').text(udata[13] + ' ');
        $('.euname').val(uid);
        $('#uid').val(uid);
      }
    });
  }
  'use strict';
  // Detect browser for css purpose
  if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
      $('.form form label').addClass('fontSwitch');
  }
  // form switch
  $('a.switch').click(function (e) {
      $(this).toggleClass('active');
      e.preventDefault();
      if ($('a.switch').hasClass('active')) {
          $(this).parents('.form-piece').addClass('switched').siblings('.form-piece').removeClass('switched');
      }
      else {
          $(this).parents('.form-piece').removeClass('switched').siblings('.form-piece').addClass('switched');
      }
  });
  $('body').on("keyup keypress",'#email', function(e){
    if (e.shiftKey && e.keyCode === 50) {
      $("#email").attr('readonly', true);
      $("#email").val(function() { return this.value + 'zesto.com.ph'; });
    }
  });
});
// Add Pointer Mecha
$("a").addClass("pointer");



// Scrollbar Mecha
$(function() {
  $('body').overlayScrollbars({
    className       : "os-theme-dark",
    resize          : "both",
    sizeAutoCapable : true,
    paddingAbsolute : true,
    scrollbars : {
      clickScrolling : true,
      autoHide : 'scroll',
    }
  });
});
// Loaders
$("#sidebar").load("../../content/parts/sidenav.php");
function contentloader(loadid) {
  console.clear();
  $("#bodyid").val(loadid);
  Cookies.remove('appid');
  Cookies.set("appid", loadid);
  if (loadid == 0) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/home.php");
    $('.section_name').text('Home');
  }
  else if (loadid == 1) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/upload.html");
    $('.section_name').text('Data Uploader');
  }
  else if (loadid == 2) { $(location).attr('href', '../../content/parts/calendar'); }
  else if (loadid == 3) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/einformation.php");
    $('.section_name').text('Employee Information');
  }
  else if (loadid == 4) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/rawdata.php");
    $('.section_name').text('Raw Data');
  }
  else if (loadid == 5) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/announcement.php");
    $('.section_name').text('Mailer');
  }
  else if (loadid == 6) {
    if (window.location.href.indexOf("calendar") > -1) { $(location).attr('href', '../../content/pages/'); }
    $("#page-content").load("../../content/parts/alreadygenerated.php");
    $('.section_name').text('AG Data');
  }
}
// Email Automation
$('#email').blur(function() {
  var value = $(this).val();
  var name = value.split(/\s*\@\s*/g);
  var splitname = name[0].split(/\s*\.\s*/g);
  if (value != '') {
    $(this).removeClass('text-capitalize').addClass('text-lowercase');
    $('#fname').val(splitname[0] + ' ' + splitname[1]);
    $('#username').val(name[0]);
  }
  else { $(this).removeClass('text-lowercase').addClass('text-capitalize'); }
});
$('#enumber').inputmask("99-999999");
$('.numberonly').keyup(function(event) { this.value = this.value.replace(/[^0-9.\.]/g,''); });
$('.letteronly').keyup(function(event) { this.value = this.value.replace(/[^A-Za-z \.]/g,''); });
$('.code').keyup(function(event) { this.value = this.value.replace(/[^A-Za-z0-9/\ \.]/g,''); });
// Calendar
document.addEventListener('DOMContentLoaded', function() {
  if (window.location.href.indexOf("calendar") > -1) {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      navLinks: true,
      businessHours: true,
      hiddenDays: [0],
      dayMaxEvents: true,
      selectable: true,
      select: function(arg) {
        $('#add-schedule').appendTo("body");
        $('#add-schedule').modal('show');
        $('#startdate').val(arg.startStr);
      },
      events: {
        url: '../../content/action/getEvent.php',
        failure: function() {
          alert();
        }
      },
      headerToolbar: {
        left: 'title',
        right: 'today,prev,next',
      },
      eventClick: function(info) {
        info.jsEvent.preventDefault();
        // alert(info.event.id);
      }
    });
    calendar.render();
  }
});
// Time Logic
let $select = $("#sched-stime");
for (let hr = 8; hr < 17; hr++) {
  let hrStr = hr.toString().padStart(2, "0") + ":";
  let val = hrStr + "00";
  $select.append('<option val="' + val + '">' + val + '</option>');
  val = hrStr + "30";
  $select.append('<option val="' + val + '">' + val + '</option>');
}
$('#sched-stime').on('change', function(e) {
  $('#sched-etime').find('option').remove().end();
  let $select = $("#sched-etime");
  var stime = $(this).val();
  stime = stime.replace(/[^0-9]/g, "");
  var etime = "23:00";
  let x = {
    slotInterval: 30,
    openTime: stime,
    closeTime: etime
  };
  let startTime = moment(x.openTime, "HH:mm");
  let endTime = moment(x.closeTime, "HH:mm");
  let allTimes = [];
  while (startTime < endTime) {
    allTimes.push(startTime.format("HH:mm"));
    startTime.add(x.slotInterval, 'minutes');
  }
  for (i = 0; i < allTimes.length; i++) {
    $select.append('<option val="' + allTimes[i] + '">' + allTimes[i] + '</option>');
  }
});
// Checkbox Wholeday
$('#wholeday').change(function(){
  if ($('#wholeday').is(':checked')) {
    $('#sched-etime').prop('required', false);
    $('#sched-etime').prop('disabled', true);
    $('#sched-etime').val('');
  }
  else {
    $('#sched-etime').prop('required', true);
    $('#sched-etime').prop('disabled', false);
  }
});
// Schedule Mecha
$('#formschedule').on('submit', function(e) {
  // $('#btnSave').prop("disabled", true);
  // $("#btnSave").html('Loading ...');
  var raw = $('#rawdata').val();
  var uid = $('#uid').val();
  e.preventDefault();
  $.ajax({
      type: 'POST',
      url: '../../content/action/formschedule.php',
      data: $('#formschedule').serialize() + '&uid=' + uid,
      success: function(data) {
          Push.create("ZestCARs", {
              body: data,
              icon: 'https://img.favpng.com/22/25/10/zest-o-philippines-logo-corporation-business-png-favpng-Brbj4NqJYBXtHd0E28th7r3dQ.jpg',
              //timeout: 4000,
              onClick: function() {
                  window.focus();
                  this.close();
                  $('#add-schedule').modal('hide');
              },
              onClose: function() {
                  window.location.href = '';
                  $('#add-schedule').modal('hide');
              },
          });
      }
  });
});