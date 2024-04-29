import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

function ShowReply({ mjoinId }) {
  const [htmlContent, setHtmlContent] = useState('');

  useEffect(() => {
    const abortController = new AbortController();

    const fetchData = async () => {
      try {
        const response = await fetch(`/front-reply/${mjoinId}`, {
          signal: abortController.signal
        });
        const responseData = await response.json();
        setHtmlContent(responseData.htmlContent);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData(); // 初始加载数据

    // 设置定时器，每隔一段时间重新加载数据
    const interval = setInterval(fetchData, 2000);

    // 在组件销毁时清除定时器和取消数据请求
    return () => {
      clearInterval(interval);
      abortController.abort();
    };
  }, [mjoinId]);

  return <div className="ShowAllMessage" dangerouslySetInnerHTML={{ __html: htmlContent }} />;
}

// 将组件渲染到页面上
const element = document.getElementById('showAllMessageContainer');
ReactDOM.render(<ShowReply mjoinId={ '{{ $mjoin->id }}' } />, element);

