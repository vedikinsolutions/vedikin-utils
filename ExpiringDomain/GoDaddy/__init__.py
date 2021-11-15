import sys
import os
import time
from selenium import webdriver 
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
from colorama.initialise import deinit
from Tools.scripts.dutree import display
from _ast import Try
from itertools import count
from pyautogui import KEYBOARD_KEYS, press, click
import pyperclip
from _datetime import datetime
from selenium.webdriver.common import by
from selenium.webdriver.common.by import By
from copy import copy
import requests
from bs4 import BeautifulSoup
import pandas as pd
from wikipedia.wikipedia import page
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait


 


save_path = 'D:/Chilka Patel/Eclipse_Workspace/domains/godaddy_expiring_domains/'
driver = webdriver.Chrome(ChromeDriverManager().install())
driver.maximize_window()
driver.delete_all_cookies()
driver.set_page_load_timeout(10)
driver.implicitly_wait(10)
driver.get('https://in.auctions.godaddy.com/')
time.sleep(10)

driver.find_element_by_xpath('//*[@id="ddlPredefinedSelect"]').click()
driver.find_element_by_xpath('//*[@id="ddlPredefinedSelect"]').send_keys('A-Z Listings')
driver.find_element_by_xpath('//*[@id="ddlPredefinedSelect"]').click()
time.sleep(10)
driver.find_element_by_xpath('//*[@id="ddlRowsToReturn"]').click()
driver.find_element_by_xpath('//*[@id="ddlRowsToReturn"]').send_keys('500')
driver.find_element_by_xpath('//*[@id="ddlRowsToReturn"]').click()
time.sleep(10)
driver.find_element_by_xpath('//*[@id="s_ddlAZSort"]').click()
driver.find_element_by_xpath('//*[@id="s_ddlAZSort"]').send_keys('All Listings')
driver.find_element_by_xpath('//*[@id="s_ddlAZSort"]').click()
time.sleep(10)
driver.find_element_by_xpath('/html/body/table/tbody/tr[1]/td/form[3]/table[3]/tbody/tr/td/div[5]/table/tbody/tr[4]/td/table/tbody/tr[1]/td[10]/b/u').click()
time.sleep(15)




#searchTable =  driver.find_elements_by_id('search-table');
wait = WebDriverWait(driver, 10)
searchTable = wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "#search-table")))

fileName = datetime.now().strftime("%Y%m%d_%H%M%S") +".csv"
f = open(save_path + fileName, "w", encoding='utf-8')
f.write(searchTable.text)
f.close()
time.sleep(10)
driver.find_element_by_xpath('/html/body/table/tbody/tr[1]/td/form[3]/table[3]/tbody/tr/td/div[5]/table/tbody/tr[2]/td/table/tbody/tr/td[2]/table/tbody/tr/td/table/tbody/tr/td[4]/a/img').click()
time.sleep(5)

# time.sleep(10)
# driver.find_element_by_xpath('/html/body/table/tbody/tr[1]/td/form[3]/table[3]/tbody/tr/td/div[5]/table/tbody/tr[2]/td/table/tbody/tr/td[2]/table/tbody/tr/td/table/tbody/tr/td[4]/a/img').click()

time.sleep(10)
for i in range(1288):
    wait = WebDriverWait(driver, 10)
    searchTable = wait.until(EC.presence_of_element_located((By.CSS_SELECTOR, "#search-table")))

    fileName = datetime.now().strftime("%Y%m%d_%H%M%S") +".csv"
    f = open(save_path + fileName, "w", encoding='utf-8')
    f.write(searchTable.text)
    f.close()
    time.sleep(10)
    driver.find_element_by_xpath('/html/body/table/tbody/tr[1]/td/form[3]/table[3]/tbody/tr/td/div[5]/table/tbody/tr[2]/td/table/tbody/tr/td[2]/table/tbody/tr/td/table/tbody/tr/td[4]/a/img').click()
    time.sleep(5)
    
        
driver.close()







 







