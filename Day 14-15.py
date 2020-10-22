#!/usr/bin/env python
# coding: utf-8

# # Question1

# In[4]:


import numpy as np
arr = np.random.random((3,3,3))
print(arr)


# # Question 2
# 

# In[8]:


x = np.diag((1,2,3,4,5))
print(x)


# # Quetsion 3 
# 

# In[9]:


y = np.zeros((8,8),dtype=int)
y[1::2,::2] = 1
y[::2,1::2] = 1
print(y)


# # Question 5
# 

# In[11]:


array1 = np.array([1,2,3,4,5,6,7,8])
array2 = np.array([6,7,8,9,10])
array3 = np.intersect1d(array1,array2)
print(array3)


# 
# # Question 6

# In[23]:


import datetime 
today = datetime.date.today()
yesterday = today - datetime.timedelta(days = 1)
tomorrow = today + datetime.timedelta(days = 1) 
print('Yesterday : ',yesterday)
print('Today : ',today)
print('Tomorrow : ',tomorrow)


# # Quetion 7

# In[27]:


x = np.random.randint((3,3))
print(x)
y = np.random.randint((3,3))
print(y)


# In[28]:


z = np.allclose(x, y)
print(z)


# # Question 8
# 

# In[30]:


a = np.random.random(10)
print(a)


# In[31]:


a[a.argmax()] = 0
print(a)


# # Question 9
# 

# In[32]:


print(a[::1])


# # Question 10

# In[33]:


X = np.random.rand(5, 10)
print(X)
print("\nSubtract the mean of each row of the said matrix:\n")
Y = X - X.mean(axis=1, keepdims=True)
print(Y)


# In[ ]:




