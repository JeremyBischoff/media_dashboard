import React, { useState, useEffect } from 'react';
import api from '../../services/api';
import TaskItem from './TaskItem';
import TaskForm from './TaskForm';

const TaskList = () => {
  const [tasks, setTasks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Runs once on initial render
  useEffect(() => {
    fetchTasks();
  }, []);

  const fetchTasks = async () => {
    try {
      setLoading(true);
      const response = await api.get('/tasks');
      console.log('Raw API response:', response); // Debug the actual response
      
      // Handle different response structures
      const tasksData = response.data.data || response.data || [];
      setTasks(Array.isArray(tasksData) ? tasksData : []);
      setError(null);
    } catch (err) {
      console.error('Fetch error details:', err);
      setError('Error fetching tasks: ' + (err.message || 'Unknown error'));
    } finally {
      setLoading(false); // Ensure this always runs
    }
  };

  const addTask = async (newTask) => {
    try {
      const response = await api.post('/tasks', newTask);
      setTasks([...tasks, response.data.data]);
    } catch (err) {
      setError('Error adding task');
      console.error(err);
    }
  };

  const deleteTask = async (id) => {
    try {
      await api.delete(`/tasks/${id}`);
      setTasks(tasks.filter(task => task.id !== id));
    } catch (err) {
      setError('Error deleting task');
      console.error(err);
    }
  };

  const toggleComplete = async (id, completed) => {
    try {
      const task = tasks.find(t => t.id === id);
      const response = await api.put(`/tasks/${id}`, {
        ...task,
        completed: !completed
      });
      setTasks(tasks.map(task => 
        task.id === id ? response.data.data : task
      ));
    } catch (err) {
      setError('Error updating task');
      console.error(err);
    }
  };

  if (loading) return <div>Loading tasks...</div>;
  if (error) return <div className="error">{error}</div>;

  return (
    <div className="task-list">
      <h1>Task Manager</h1>
      <TaskForm onAddTask={addTask} />
      {tasks.length === 0 ? (
        <p>No tasks yet. Add one above!</p>
      ) : (
        <div className="tasks">
          {tasks.map(task => (
            <TaskItem 
              key={task.id} 
              task={task} 
              onDelete={deleteTask}
              onToggleComplete={toggleComplete}
            />
          ))}
        </div>
      )}
    </div>
  );
};

export default TaskList;