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

 import React from 'react';
import { render, fireEvent, waitFor } from '@testing-library/react';
import { act } from 'react-dom/test-utils';
import ShowReply from './ShowReply'; // Import the component you want to test

jest.mock('react-dom/client', () => ({
  createRoot: () => ({
    render: jest.fn(),
  }),
}));

jest.mock('react-dom/test-utils', () => ({
  act: jest.fn(),
}));

jest.mock('react-fetch-data', () => ({
  useFetchData: jest.fn(() => {
    return {
      data: 'initialData',
      error: null,
      isLoading: false,
      refetch: jest.fn(),
    };
  }),
}));

describe('ShowReply component', () => {
  it('renders without crashing', () => {
    render(<ShowReply mjoinId="123" />);
  });

  it('fetches data when component mounts', async () => {
    const mockFetchData = jest.fn();
    jest.mock('react-fetch-data', () => ({
      useFetchData: () => mockFetchData(),
    }));

    render(<ShowReply mjoinId="123" />);

    await waitFor(() => {
      expect(mockFetchData).toHaveBeenCalledWith(`/front-reply/123`);
    });
  });

  it('updates data when useFetchData updates', async () => {
    const mockFetchData = jest.fn();
    jest.mock('react-fetch-data', () => ({
      useFetchData: () => mockFetchData(),
    }));

    const { getByTestId } = render(<ShowReply mjoinId="123" />);

    await waitFor(() => {
      expect(getByTestId('showAllMessage_123').innerHTML).toBe('initialData');
    });

    mockFetchData.mockImplementationOnce(() =>
      Promise.resolve({
        data: 'newData',
        error: null,
        isLoading: false,
        refetch: jest.fn(),
      })
    );

    act(() => {
      mockFetchData();
    });

    await waitFor(() => {
      expect(getByTestId('showAllMessage_123').innerHTML).toBe('newData');
    });
  });

  it('closes WebSocket connection when component unmounts', async () => {
    const mockWebSocket = jest.fn();
    jest.mock('react-websocket', () => ({
      useWebSocket: () => mockWebSocket(),
    }));

    const { unmount } = render(<ShowReply mjoinId="123" />);

    await waitFor(() => {
      expect(mockWebSocket).toHaveBeenCalledWith(`ws://127.0.0.1:8000/front-reply/123`);
    });

    unmount();

    await waitFor(() => {
      expect(mockWebSocket.mock.calls[1][0].close).toBeCalled();
    });
  });
});
 