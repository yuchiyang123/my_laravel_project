/*import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';

function ShowReply({ mjoinId }) {
  const [htmlContent, setHtmlContent] = useState('');
  const [error, setError] = useState(null);

  useEffect(() => {
    const abortController = new AbortController();

    const fetchData = async () => {
      try {
        const response = await fetch(`/front-reply/${mjoinId}`, {
          signal: abortController.signal
        });
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const responseData = await response.json();
        setHtmlContent(responseData.htmlContent);
        setError(null);
      } catch (error) {
        console.error('Error fetching data:', error);
        setError(error.message);
      }
    };

    fetchData(); // 初始加载数据

    // 设置定时器，每隔一段时间重新加载数据
    const interval = setInterval(fetchData, 2000);

    // 在组件被卸载时清理定时器和取消数据请求
    return () => {
      clearInterval(interval);
      abortController.abort();
    };
  }, [mjoinId]);

  return (
    <div className="ShowAllMessage" id={`showAllMessage_${mjoinId}`}>
      {error ? (
        <div>Error: {error}</div>
      ) : (
        <div dangerouslySetInnerHTML={{ __html: htmlContent }} />
      )}
    </div>
  );
}*/

// 将组件渲染到页面上
/*
if (document.getElementById('showAllMessage_')) {
    var data = document.getElementById('showAllMessage_').getAttribute('data');
    ReactDOM.render(<Example data={data} />, document.getElementById('showAllMessage_'));
 }*/

import React, { useState, useEffect } from 'react';

function ShowReply({ mjoinId }) {
  const [htmlContent, setHtmlContent] = useState('');

  useEffect(() => {
    // 建立 WebSocket 連接
    const socket = new WebSocket(`ws://example.com/front-reply/${mjoinId}`);

    // 處理收到的訊息
    socket.onmessage = (event) => {
      setHtmlContent(event.data);
    };

    // 在組件卸載時關閉連接
    return () => {
      socket.close();
    };
  }, [mjoinId]);

  return (
    <div className="ShowAllMessage" id={`showAllMessage_${mjoinId}`}>
      <div dangerouslySetInnerHTML={{ __html: htmlContent }} />
    </div>
  );
}
