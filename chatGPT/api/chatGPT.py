#-*- coding:utf-8 -*-
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
"""
# <프롬프트 작성법>
1.지시문
	프롬프트에세 어떤 업무를 시킬 지 지시하는 것
2.문맥
	어떤 배경을 가지고 있는지,
	내가 왜 이 질문을 하는지에 대한 이유
3.예시
	프롬프트의 결과를
	어떤 방식으로 원하는지 예시 제공
4.페르소나
	어떤 인물의 관점과 언어로
	답변을 원하는지 역할 지정
5.포맷
	어떤 형식으로 나와야 하는지 정의
6.톤
	어떤 톤으로 나와야 하는지 정의
"""


"""
import openai

# API 키 설정
openai.api_key = 'api_key'

model_engine = "text-davinci-002"
prompt = "In the year 2050, the world will be a better place because"

# chat gpt api 호출
response = openai.Completion.create(
	engine=model_engine,
	prompt=prompt,
	max_tokens=1024,
	n=1,
	stop=None,
	temperature=0.5,
)
# 답변
answer = response.choices[0].text.strip()
answer = response.choices[0].text
"""


# print() 함수로 php로 값을 넘겨줄 수 있다.
def call(var_1):
	# 사용자 질문
	#q = {'question':var_1}
	#print(q)

	# openAI 대답
	#print('대답')
	#print('안녕하세요.<br>제 이름은 미래AI입니다. 궁금한 것이 있으면 무엇이든지 물어보세요.<br>ㅎㅎㅎㅎㅎ')

	answer = '안녕하세요.<br>제 이름은 미래AI입니다. 궁금한 것이 있으면 무엇이든지 물어보세요.'

	if var_1 == '':
		answer = '아무것도 입력하지 않았습니다. 궁금한 것이 있으면 말씀해주세요.'

	return {'question':var_1, 'answer':answer}

result = call(sys.argv[1])

for k, v in result.items():
	print("%s: %s" % (k, v))