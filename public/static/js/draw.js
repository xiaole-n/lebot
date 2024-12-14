/*
 * @author: 夜夜 <260088833@qq.com>
 * @hitokoto: 保持心脏震动，有人与你共鸣。
 * Copyright (c) 2023 竹听雨 All Rights Reserved
 */

/**
 * @description 获取指定名称的cookie值
 * @param {string} name - cookie的名称
 * @returns {string|null} - 返回cookie的值或者null
 */
function getCookie (name)
{
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(name + '=') === 0) {
            return cookie.substring(name.length + 1, cookie.length);
        }
    }
    return null;
}

/**
 * 将指定id的HTML内容缓存到localStorage中
 * 
 * @param {string} id - 要缓存HTML的元素的id
 * @param {string} key - 存储缓存内容的键名
 */
function cacheHtmlById (id, key)
{
    // 通过id获取指定元素节点
    const node = document.getElementById(id);
    // 获取元素的HTML内容
    const html = node.innerHTML;
    // 将HTML内容转换为字符串并存储到localStorage中
    localStorage.setItem(key, JSON.stringify(html));
}

/**
 * @description 获取localStorage中指定key的缓存HTML内容
 * @param {string} key - 键名
 * @returns {object} - 缓存的HTML内容
 */
function getCachedHtml (key)
{
    const cachedHtml = localStorage.getItem(key);
    return JSON.parse(cachedHtml);
}

/**
 * @description 将缓存的HTML内容插入指定id的元素中
 * @param {string} id - 元素id
 * @param {string} key - 键名
 * @returns {boolean} - 是否成功插入缓存的HTML内容
 */
function addCachedHtmlById (id, key)
{
    // 获取指定key的缓存HTML内容
    const cachedHtml = getCachedHtml(key);
    // 根据id获取指定元素
    const el = document.getElementById(id);
    // 如果元素存在且缓存的HTML内容不为空
    if (el && cachedHtml !== null && cachedHtml !== undefined) {
        // 将缓存的HTML内容插入元素中
        el.innerHTML = cachedHtml;
        return true;
    } else {
        return false;
    }
}

/**
 * 生成指定长度的随机字符串
 * @param {number} len - 需要生成的随机字符串的长度，默认为32
 * @returns {string} - 生成的随机字符串
 */
function randomString (len)
{
    len = len || 32;
    var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
    /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
    var maxPos = $chars.length;
    var pwd = '';
    for (i = 0; i < len; i++) {
        pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

/**
 * @param {number} timestamp 时间戳
 * @returns {string} 格式化后的日期字符串
 */
function formatDate (timestamp)
{
    var date = new Date(timestamp);
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2); // 月份是从0开始的
    var day = ('0' + date.getDate()).slice(-2);
    var hours = ('0' + date.getHours()).slice(-2);
    var minutes = ('0' + date.getMinutes()).slice(-2);
    var seconds = ('0' + date.getSeconds()).slice(-2);

    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
}

/**
 * 从消息内容中提取内容
 * @param {string} messageContent - 消息内容
 * @returns {string} - 提取后的内容
 */
function extractContent (messageContent)
{
    // 移除 <@数字> 部分
    let extractedContent = messageContent.replace(/<@\d+>/g, "");

    // 移除所有星号
    extractedContent = extractedContent.replace(/\*\*/g, "");

    // 移除可能的多余空格
    extractedContent = extractedContent.trim();

    return extractedContent;
}

/**
 * 从字符串中截取前40个字符，尽量避免切断单词，并在末尾添加省略号（如果需要）
 * @param {string} text - 原始字符串
 * @returns {string} - 处理后的字符串
 */
function truncateText (text)
{
    // 设置截取的最大长度
    const maxLength = 40;

    // 如果文本本身就短于或等于最大长度，直接返回原文本
    if (text.length <= maxLength) {
        return text;
    }

    // 截取前 maxLength 个字符
    let truncated = text.slice(0, maxLength);

    // 检查截取后的字符串是否在单词中间断开
    // 如果是，则尝试回退到最近的空格处
    if (text[maxLength] !== ' ') {
        const lastSpace = truncated.lastIndexOf(' ');
        if (lastSpace > 0) {
            truncated = truncated.slice(0, lastSpace);
        }
    }

    // 在截取的字符串后添加省略号
    return truncated + '...';
}

function queryDrawStatus (result, userqq, prompt)
{
    var intervalId; // 用于存储 setInterval 的返回值
    var maxRequestTime = 15 * 60 * 1000; // 最大请求时间为 15 分钟
    var startTime = Date.now(); // 记录开始时间
    var userCK = 'user_' + getCookie('user');

    if (!userCK) {
        document.cookie = 'user_A=LcuckyNight; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
        userCK = 'user_A';
    }

    $("#prompt").val("请等待……");
    $("#prompt").attr("disabled", true);
    $("#DrawBoxMsg").hide();
    $("#send_draw").html('<i class="text-danger far fa-circle-stop opacity-50"></i> 进行中 ');

    // 生成一个唯一的标识符，用于返回消息的容器
    var answer = randomString(16);

    // 是否已经创建了返回消息的容器
    var responseContainerCreated = false;

    function query () {
		x.ajax('/index/tool/query', {
			result: result
		}, function (data) {
			let BotName = '';
			if (data.data.properties.botType === 'MID_JOURNEY') {
				BotName = 'Midjourney Bot';
			} else if (data.data.properties.botType === 'NIJI_JOURNEY') {
				BotName = 'niji・journey Bot';
			}

			let BotImg = '';
			if (BotName === 'Midjourney Bot') {
				BotImg = '/static/media/photos/midjourney.webp';
			} else if (BotName === 'niji・journey Bot') {
				BotImg = '/static/media/photos/niji.webp';
			}

			let StatusChinese = '';
			if (data.data.status === 'NOT_START') {
				StatusChinese = '未启动';
			} else if (data.data.status === 'SUBMITTED') {
				StatusChinese = '已提交';
			} else if (data.data.status === 'MODAL') {
				StatusChinese = '窗口等待';
			} else if (data.data.status === 'IN_PROGRESS') {
				StatusChinese = '进行中';
			} else if (data.data.status === 'FAILURE') {
				StatusChinese = '失败';
			} else if (data.data.status === 'SUCCESS') {
				StatusChinese = '成功';
			} else if (data.data.status === 'CANCEL') {
				StatusChinese = '已取消';
			}

			let StatusClass = '';
			if (StatusChinese === '未启动') {
				StatusClass = 'volcano';
			} else if (StatusChinese === '已提交') {
				StatusClass = 'lime';
			} else if (StatusChinese === '窗口等待') {
				StatusClass = 'cyan';
			} else if (StatusChinese === '进行中') {
				StatusClass = 'geekblue';
			} else if (StatusChinese === '失败') {
				StatusClass = 'red';
			} else if (StatusChinese === '成功') {
				StatusClass = 'green';
			} else if (StatusChinese === '已取消') {
				StatusClass = 'magenta';
			}

			if (!responseContainerCreated) {
				// 插入返回消息的容器
				$("#article-wrapper").append('<div class="clearfloat"><div class="right"><div class="chat-message fs-sm" id="q' + answer + '"><span style="margin-bottom: 0;"></span></div><div class="chat-avatars"><img src="//q2.qlogo.cn/g?b=qq&nk=' + userqq + '&s=100"></div></div></div>');
				for (let j = 0; j < prompt.length; j++) {
					$("#q" + answer).children('span').text($("#q" + answer).children('span').text() + prompt[j]);
				};
				$("#article-wrapper").append('<div class="clearfloat"> <div class="left"><div class="chat-avatars"><img src="' + BotImg + '"></div><div class="chat-message bg-body fs-sm" id="' + answer + '"><div id="BotMessage-' + answer + '"></div></div></div></div>');
				$("#BotMessage-" + answer).html('<p class="line" data-line="0">提交成功，请等待...</p>');
				responseContainerCreated = true; // 标记已创建容器
			}

			if (data.data.id !== result) {
				x.notify('任务错误', 'danger');
			} else if (data.data.status === 'FAILURE' || StatusChinese === '失败' || data.data.failReason !== null) {
				// 处理任务失败
				$("#BotMessage-" + answer).html('<p class="line mb-2" data-line="0">' + BotName + ' ' + formatDate(data.data.submitTime) + '</p> <p class="line mb-2" data-line="0">' + data.data.failReason + '</p> <p class="line mb-2" data-line="0"><span class="ant-tag ant-tag-' + StatusClass + '">' + StatusChinese + '</span></p>');
				$("#prompt").val("");
				$("#prompt").attr("disabled", false);
				$("#send_draw").html('<i class="fa fa-bolt-lightning opacity-50"></i> 开始绘画');
				clearInterval(intervalId); // 停止循环查询
			} else if (data.data.status === 'CANCEL' || StatusChinese === '已取消') {
				// 处理取消的任务
				let messageContent = '';
				if (data.data.properties.messageContent === '') {
					messageContent = data.data.description;
				} else {
					messageContent = extractContent(data.data.properties.messageContent);
				}
				$("#BotMessage-" + answer).html('<p class="line mb-2" data-line="0">' + BotName + ' ' + formatDate(data.data.submitTime) + '</p> <p class="line mb-2" data-line="0">' + messageContent + '</p> <p class="line mb-2" data-line="0"><span class="ant-tag ant-tag-' + StatusClass + '">' + StatusChinese + '</span></p>');
				$("#prompt").val("");
				$("#prompt").attr("disabled", false);
				$("#send_draw").html('<i class="fa fa-bolt-lightning opacity-50"></i> 开始绘画');
				clearInterval(intervalId); // 停止循环查询
			}else if (data.data.progress === '100%') {
				// 处理任务成功
				// 获取 Buttons 按钮数组
				var buttons = data.data.buttons;
				var buttonsHtml = '';
				// 遍历按钮数组
				buttons.forEach(function(button) {
					// 优先使用 label，如果 label 为空，则使用 emoji
					var buttonText = button.label || button.emoji;

					// 创建按钮的 HTML 字符串
					buttonsHtml += '<button type="button" class="ant-tag ant-tag-blue" id="Change" data-custom-id="' + button.customId + '" data-task-id="' + data.data.id + '" onclick="change_draw()">' + buttonText + '</button>';
				});
				$("#BotMessage-" + answer).html('<p class="line mb-2" data-line="0">' + BotName + ' ' + formatDate(data.data.submitTime) + '</p> <p class="line mb-2" data-line="0">' + extractContent(data.data.properties.messageContent) + '</p> <p class="line mb-2" data-line="0"><span class="ant-tag ant-tag-' + StatusClass + '">' + StatusChinese + '</span> </p> <div class="row"> <div class="col-md-6"> <div class="block-content block-content-full"> <div class="carousel slide"> <div class="carousel-inner"> <div class="carousel-item active"> <img onclick="javascript:window.open(\'' + data.data.imageUrl + '\')" src="' + data.data.imageUrl + '" class="d-block w-100" style="border-radius: 10px;" alt="' + data.data.promptEn + '" data-bs-toggle="tooltip" title="' + data.data.promptEn + '"> <div class="carousel-caption d-none d-md-block bg-black-50 rounded-3 px-3"> <h5 class="h3 mb-2 image-author">@' + data.data.action + '</h5> <p class="mb-0 image-desc">' + truncateText(data.data.promptEn) + '</p> </div> </div> </div> </div> </div> </div> <div class="col-md-6 draw-buttons"> <div class="block-content block-content-full text-center"> ' + buttonsHtml + ' </div> </div> </div>');
				$("#prompt").val("");
				$("#prompt").attr("disabled", false);
				$("#send_draw").html('<i class="fa fa-bolt-lightning opacity-50"></i> 开始绘画');
				clearInterval(intervalId); // 停止循环查询
			} else {
				// 处理任务进行中
				let messageContent = '';
				if (data.data.properties.messageContent === '') {
					messageContent = data.data.description;
				} else {
					messageContent = extractContent(data.data.properties.messageContent);
				}
				$("#BotMessage-" + answer).html('<p class="line mb-2" data-line="0">' + BotName + ' ' + formatDate(data.data.submitTime) + ' <button type="button" class="ant-tag ant-tag-purple" id="Cancel" data-result="' + data.data.id + '" onclick="stop_draw()"> <i class="si si-close"></i> </button> </p> <p class="line mb-2" data-line="0">' + messageContent + '</p> <p class="line mb-2" data-line="0"><span class="ant-tag ant-tag-' + StatusClass + '">' + StatusChinese + '</span></p>');
			}

			// 判断是否超过最大请求时间，超过则停止循环查询
			var currentTime = Date.now();
			if (currentTime - startTime > maxRequestTime) {
				// 处理超时的任务
				$("#BotMessage-" + answer).html('<p class="line mb-2" data-line="0">' + BotName + ' ' + formatDate(data.data.submitTime) + '</p> <p class="line mb-2" data-line="0">任务超时</p> <p class="line mb-2" data-line="0"><span class="ant-tag ant-tag-red">失败</span></p>');
				$("#prompt").val("");
				$("#prompt").attr("disabled", false);
				$("#send_draw").html('<i class="fa fa-bolt-lightning opacity-50"></i> 开始绘画');
				clearInterval(intervalId); // 停止循环查询
			}

			// 缓存聊天记录
			cacheHtmlById('article-wrapper', userCK);
		});
	}

	// 第一次立即执行查询
	query();

	// 设置每隔 10 秒执行一次查询
	intervalId = setInterval(query, 10 * 1000);
}