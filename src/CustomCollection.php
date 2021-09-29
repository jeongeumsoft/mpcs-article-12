<?php

namespace Exit11\Article;

use Illuminate\Database\Eloquent\Collection;

class CustomCollection extends Collection
{

	/**
	 * filterNestedSearch: 네스티드 검색 필터링
	 *
	 * @return void
	 */
	public function filterNestedSearch($model)
	{
		$nestedParams = $model->getNestedParams();
		if (count($nestedParams) <= 0) {
			return $this;
		}

		$this->transform(function ($item, $key) {
			return $this->filterNestedSearchProc($item);
		});
		$result = $this->reject(function ($item) {
			return empty($item);
		});

		return $result;
	}

	/**
	 * filterNestedSearchProc
	 *
	 * @return void
	 */
	public function filterNestedSearchProc($item)
	{
		// 모델이 조건을 만족하는 경우: 하위 모델까지 모두 조회
		if ($item->is_nested_searched === true) {
			return $item;
		}

		// 모델이 조건을 만족하지 않는 경우: 하위 모델 탐색
		// if ($item->allChildren && $item->where('is_nested_searched', true)) {
		if ($item->allChildren) {

			$item->allChildren->transform(function ($item, $key) {
				return $this->filterNestedSearchProc($item);
			});
			$item->allChildren = $item->allChildren->reject(function ($item) {
				return empty($item);
			});

			// 조건에 해당하는 하위 모델이 있는 경우에만 조회
			if (count($item->allChildren) >= 1) {
				return $item;
			}
		}

		return null;
	}
}
